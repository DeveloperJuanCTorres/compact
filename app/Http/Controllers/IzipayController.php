<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Taxonomy;
use Exception;
use Cart;
use Gloudemans\Shoppingcart\Cart as ShoppingcartCart;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
use Illuminate\Http\Request;

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

        $body = [
            "amount" => (int) (floatval(str_replace(',', '', Cart::subtotal())) * 100),
            "currency" => "PEN",
            "orderId" => "1234",
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

        return view('izipay.result', compact('orderStatus', 'answer'));
    }

    public function ipn(Request $request)
    { 
        if (empty($request)) {
            throw new Exception("No post data received!");
        }
          
        // Validación de firma en IPN
        if (!$this->checkHash($request, env("IZIPAY_PASSWORD"))) {
            throw new Exception("Invalid signature");
        }

        $answer = json_decode($request["kr-answer"], true);
        $transaction = $answer['transactions'][0];
        
        // Verifica orderStatus PAID
        $orderStatus = $answer['orderStatus'];
        $orderId = $answer['orderDetails']['orderId'];
        $transactionUuid = $transaction['uuid'];

        return 'OK! OrderStatus is ' . $orderStatus;
    }

    private function checkHash($request, $key)
    {
        $krAnswer = str_replace('\/', '/',  $request["kr-answer"]);
        
        $calculateHash = hash_hmac("sha256", $krAnswer, $key);

        return ($calculateHash == $request["kr-hash"]);
    }
}
