<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Taxonomy;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
     public function add(Request $request)
    {
        try {
            $producto = Product::find($request->id);
            if (empty($producto)) {
                return redirect('/');
            }
            $imagen = json_decode($producto->images);
            if ($imagen) {
                $img = 'storage/' . $imagen[0];
            }
            else{
                $img = 'img/defectomaster.jpeg';
            }
            Cart::add(
                $producto->id,
                $producto->name,
                $request->qty,
                $producto->price,
                ["image"=>$img]
            );

            return response()->json(['status' => true, 'msg' => 'Porducto se agrego a su carrito', 'count' => Cart::count()]);

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
