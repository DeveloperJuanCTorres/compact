<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CatalogoController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->get();

        $products->map(function ($product) {
            $images = json_decode($product->images, true);
            $product->first_image = $images[0] ?? null;
            return $product;
        });

        $pdf = Pdf::loadView('catalogo.index', compact('products'));
        return $pdf->download('catalogo.pdf');
    }
}
