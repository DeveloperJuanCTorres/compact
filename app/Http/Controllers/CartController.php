<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Taxonomy;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
     public function add(Request $request)
    {
        try {
            $producto = Product::find($request->id);
            if (empty($producto)) {
                return response()->json(['status' => false, 'msg' => 'Producto no encontrado']);
            }

            // ✅ variantes
            $colorId = $request->color_id ?? 0;
            $sizeId  = $request->size_id ?? 0;

            // Para mostrar en carrito (opcional)
            $colorName = $colorId ? optional(\App\Models\Color::find($colorId))->name : null;
            $sizeName  = $sizeId ? optional(\App\Models\Size::find($sizeId))->talla : null;

            // ✅ Imagen por color (si existe)
            $img = 'img/defectomaster.jpeg'; // por defecto
            if ($colorId) {
                $colorImage = \App\Models\ProductColorImage::where('product_id', $producto->id)
                                ->where('color_id', $colorId)
                                ->first();
                if ($colorImage) {
                    $img = 'storage/' . $colorImage->image; // asumiendo que en BD guardas el path relativo
                }
            }

            // Si no tiene color o no encontró imagen, usar primera imagen general
            if ($img === 'img/defectomaster.jpeg') {
                $imagenes = json_decode($producto->images);
                if ($imagenes && isset($imagenes[0])) {
                    $img = 'storage/' . $imagenes[0];
                }
            }

            // ID único en carrito
            $uniqueId = $producto->id . '-' . $colorId . '-' . $sizeId;

            Cart::add(
                $uniqueId,
                $producto->name,
                $request->qty ?? 1,
                $producto->price,
                [
                    "image"      => $img,
                    "color_id"   => $colorId ?: null,
                    "size_id"    => $sizeId ?: null,
                    "color_name" => $colorName,
                    "size_name"  => $sizeName
                ]
            );

            return response()->json([
                'status' => true,
                'msg'    => 'Producto agregado al carrito',
                'count'  => Cart::count()
            ]);

        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }       
    }

    public function cart()
    {
        $business = Company::find(1);
        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->get();

        return view('cart.cart',compact('categories','business'));
    }

    public function update(Request $request)
    {
        $rowId = $request->rowId;
        $qty   = $request->qty;

        \Cart::update($rowId, $qty);

        $item = \Cart::get($rowId);

        // cálculos
        $subtotalGeneral = (float) str_replace(',', '', \Cart::subtotal()); 
        $igv = $subtotalGeneral * 0.18;
        $subtotalSinIgv = $subtotalGeneral - $igv;
        $total = $subtotalGeneral;

        return response()->json([
            'success'   => true,
            'rowId'     => $rowId,
            'qty'       => $item->qty,
            'subtotalItem'  => number_format($item->price * $item->qty, 2),
            'subtotalGeneral' => number_format($subtotalSinIgv, 2),
            'igv'          => number_format($igv, 2),
            'total'        => number_format($total, 2),
        ]);
    }

    public function removeItem(Request $request)
    {
        Cart::remove($request->rowId);
        return redirect()->back()->with("success","Item eliminado");
    }

    public function clear()
    {
        Cart::destroy();
        return redirect()->back()->with("success","Carrito vacio");
    }
}
