<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmed;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Taxonomy;
use Exception;
use Cart;
use Gloudemans\Shoppingcart\Cart as ShoppingcartCart;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class IzipayController extends Controller
{
    public function izipay(Request $request)
    {
        // URL de Web Service REST
        $url = "https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePayment";

        // Encabezado Basic con concatenación de "usuario:contraseña" en base64
        $auth = env('IZIPAY_USERNAME') . ":" . env('IZIPAY_PASSWORD');

        $headers = array(
            "Authorization: Basic " . base64_encode($auth),
            "Content-Type: application/json"
        );

        
        // 👉 Y guardamos el pedido en estado PENDING en tu BD
        $order = Order::create([
            'status'   => 'PENDING',
            'total'    => (floatval(str_replace(',', '', \Cart::subtotal()))),
            'customer_name'  => $request->input("nombre"),
            'customer_lastname'  => $request->input("apellidos"),
            'customer_email' => $request->input("email"),
            'customer_phone' => $request->input("telefono"),
            'customer_address' => $request->input("direccion"),
        ]);

        $orderId = $order->id;

        foreach (\Cart::content() as $item) {
            // Construir nombre completo
            $fullName = $item->name;

            if ($item->options->color_name) {
                $fullName .= ' - Color: ' . $item->options->color_name;
            }

            if ($item->options->size_name) {
                $fullName .= ' - Talla: ' . $item->options->size_name;
            }
            $order->items()->create([
                'product_name'  => $fullName,
                'product_price' => $item->price,
                'quantity'      => $item->qty,
                'subtotal'      => $item->price * $item->qty,
            ]);
        }

        $body = [
            "amount" => (int) (floatval(str_replace(',', '', Cart::subtotal())) * 100),
            "currency" => "PEN",
            "orderId" => $orderId,
            "customer" => [
                "email" => $request->input("email"),
                "billingDetails" => [
                    "firstName" => $request->input("nombre"),
                    "lastName" => $request->input("apellidos"),
                    "phoneNumber" => $request->input("telefono"),
                    "identityType" => "DNI",
                    "identityCode" => "70539890",
                    "address" => $request->input("direccion"),
                    "country" => "PE",
                    "city" => "CHICLAYO",
                    "state" => "LAMBAYEQUE",
                    "zipCode" => "14000",
                ]
            ],
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $raw_response = curl_exec($curl);

        $response = json_decode($raw_response , true);

        // Obtenemos el formtoken generado
        $formToken = $response["answer"]["formToken"];
        
        // Obtenemos publicKey
        $publicKey = env("IZIPAY_PUBLIC_KEY");

        $business = Company::find(1);
        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->take(8)->get();

        return view('izipay.checkout', compact("publicKey", "formToken", "business", "categories"));
    }

    public function result(Request $request)
    {
        if (empty($request)) {
            throw new Exception("No post data received!");
        }
          
        // Validación de firma
        if (!$this->checkHash($request, env("IZIPAY_SHA256_KEY"))) {
            throw new Exception("Invalid signature");
        }
        
        $answer = json_decode($request['kr-answer'], true);
        $orderStatus = $answer['orderStatus'];

        $business = Company::find(1);
        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->take(8)->get();

        return view('izipay.result', compact('orderStatus', 'answer', 'business', 'categories'));
    }

    public function ipn(Request $request)
    {
        \Log::info("📩 IPN recibido", [
            'headers' => $request->headers->all(),
            'body' => $request->all()
        ]);

        if (empty($request->all())) {
            \Log::error("❌ IPN vacío recibido");
            return response("No post data received!", 400);
        }

        if (!$this->checkHash($request, env("IZIPAY_PASSWORD"))) {
            \Log::error("❌ Firma inválida en IPN", $request->all());
            return response("Invalid signature", 400);
        }

        $answer = json_decode($request["kr-answer"], true);
        $transaction = $answer['transactions'][0] ?? null;
        $orderStatus = $answer['orderStatus'] ?? null;
        $orderId = $answer['orderDetails']['orderId'] ?? null;

        \Log::info("✅ IPN válido", [
            "orderId" => $orderId,
            "orderStatus" => $orderStatus,
            "transaction" => $transaction,
        ]);

        $order = Order::find($orderId);

        if (!$order) {
            \Log::warning("⚠️ Pedido no encontrado para orderId {$orderId}");
            return response("Order not found", 404);
        }

        // Actualizar estado del pedido
        $order->update(['status' => $orderStatus]);

        if ($orderStatus === 'PAID') {
            // Enviar correo de confirmación
            Mail::to($order->customer_email)->send(new OrderConfirmed($order));

            // ============================================
            // 🔗 INTEGRACIÓN CON ESCALA CRM
            // ============================================

            $apiKey = 'qI7BSuxhkPON5iyrPZmwudQl15RnPWUmibErFi9mR3iqTe7W2g0hExkOqrM1zH8jcUtCTI4fKl7mtqHNVgh9PQ';
            $baseUrl = 'https://public-api.escala.com/v1/crm';

            // Buscar si el contacto ya existe en nuestra BD local
            $contact = Contact::where('email', $order->customer_email)->first();

            if (!$contact) {
                // Crear contacto en ESCALA
                $contactPayload = [
                    "assignedTo" => "unassigned",
                    "contacted" => false,
                    "custom" => [
                        "cf_name_text" => $order->customer_name . ' ' . $order->customer_lastname
                    ],
                    "marketable" => true,
                    "notes" => "Contacto generado automáticamente desde pedido #{$order->id}",
                    "personal" => [
                        "address" => $order->customer_address,
                        "email" => $order->customer_email,
                        "firstName" => $order->customer_name,
                        "lastName" => $order->customer_lastname,
                        "phoneNumber" => $order->customer_phone
                    ],
                    "priority" => 3,
                    "status" => "lead",
                    "triggerWorkflow" => false
                ];

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'x-api-key' => $apiKey
                ])->post("$baseUrl/contacts", $contactPayload);

                if ($response->successful()) {
                    $data = $response->json();
                    $contactId = $data['id'] ?? null;

                    if ($contactId) {
                        // Guardar en nuestra BD local
                        $contact = Contact::create([
                            'id_escala' => $contactId,
                            'first_name' => $order->customer_name,
                            'last_name' => $order->customer_lastname,
                            'address' => $order->customer_address,
                            'phone' => $order->customer_phone,
                            'email' => $order->customer_email,
                        ]);
                        \Log::info("✅ Contacto creado en ESCALA y guardado localmente", ['id_escala' => $contactId]);
                    } else {
                        \Log::error("❌ No se recibió ID al crear contacto en ESCALA", $response->json());
                    }
                } else {
                    \Log::error("❌ Error al crear contacto en ESCALA", [
                        'status' => $response->status(),
                        'body' => $response->body()
                    ]);
                }
            }

            // ============================================
            // Crear oportunidad (deal)
            // ============================================

            if ($contact) {
                $dealPayload = [
                    "assignedTo" => "unassigned",
                    "contactId" => $contact->id_escala,
                    "custom" => [
                        "cf_age_number" => 0,
                        "cf_name_text" => $order->customer_name . ' ' . $order->customer_lastname
                    ],
                    "description" => "Confirmación de pedido",
                    "name" => "Pedido #{$order->id}",
                    "pipelineId" => "36c5bcd8-a3fa-11f0-9710-d1150faa1649",
                    "priority" => 3,
                    "products" => [
                        "items" => [
                            [
                                "productId" => "d1edcc23-a3fc-11f0-9cf5-d3d8f7625e74",
                                "quantity" => 1
                            ]
                        ],
                        "updateValue" => false
                    ],
                    "stageId" => "1384b703-60e1-4e66-9ffd-ee8a1d48fc9d",
                    "triggerWorkflow" => false,
                    "value" => (float)$order->total
                ];

                $dealResponse = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'x-api-key' => $apiKey
                ])->post("$baseUrl/deals", $dealPayload);

                if ($dealResponse->successful()) {
                    \Log::info("✅ Oportunidad creada en ESCALA", $dealResponse->json());
                } else {
                    \Log::error("❌ Error al crear oportunidad en ESCALA", [
                        'status' => $dealResponse->status(),
                        'body' => $dealResponse->body()
                    ]);
                }
            }
        }

        return response("OK", 200);
    }

    // public function ipn(Request $request)
    // {
        
    //     \Log::info("📩 IPN recibido", [
    //         'headers' => $request->headers->all(),
    //         'body' => $request->all()
    //     ]);

    //     if (empty($request->all())) {
    //         \Log::error("❌ IPN vacío recibido");
    //         return response("No post data received!", 400);
    //     }

        
    //     if (!$this->checkHash($request, env("IZIPAY_PASSWORD"))) {
    //         \Log::error("❌ Firma inválida en IPN", $request->all());
    //         return response("Invalid signature", 400);
    //     }

    //     $answer = json_decode($request["kr-answer"], true);
    //     $transaction = $answer['transactions'][0] ?? null;
    //     $orderStatus = $answer['orderStatus'] ?? null;
    //     $orderId = $answer['orderDetails']['orderId'] ?? null;

    //     \Log::info("✅ IPN válido", [
    //         "orderId" => $orderId,
    //         "orderStatus" => $orderStatus,
    //         "transaction" => $transaction,
    //     ]);

       
    //      $order = Order::find($orderId);

    //     if ($order) {
    //         if ($orderStatus === 'PAID') {
    //             $order->update([
    //                 'status' => 'PAID'
    //             ]);

              
    //             Mail::to($order->customer_email)->send(new OrderConfirmed($order));
    //         } else {
    //             $order->update([
    //                 'status' => $orderStatus
    //             ]);
    //         }
    //     } else {
    //         \Log::warning("⚠️ Pedido no encontrado para orderId {$orderId}");
    //     }

    //     return response("OK", 200);
    // }
 
    private function checkHash($request, $key)
    {
        $krAnswer = str_replace('\/', '/',  $request["kr-answer"]);
        
        $calculateHash = hash_hmac("sha256", $krAnswer, $key);

        return ($calculateHash == $request["kr-hash"]);
    }
}
