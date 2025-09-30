<?php

namespace App\Http\Controllers;

use App\Mail\Contactanos;
use App\Mail\Reclamos;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Company;
use App\Models\Field;
use App\Models\Product;
use App\Models\ProductColorImage;
use App\Models\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $business = Company::find(1);
        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->take(8)->get();

        $brands = Brand::all();
        $video = Field::value('video_educativo');


        $banners = Banner::all();
        $products = Product::where('stock', '>', 0)->take(8)->get();

        return view('home.index', compact('business','categories','banners','products','brands','video'));
    }

    public function checkout()
    {
        $business = Company::find(1);
        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->take(8)->get();

        return view('cart.checkout',compact('categories','business'));
    }

    public function store(Request $request)
    {
        $business = Company::find(1);
        $products = Product::query()->where('stock', '>', 0)->where('liquidacion','!=', 1);

       
        if ($request->filled('categories')) {
            $categories = is_array($request->categories) ? $request->categories : [$request->categories];
            $products->whereIn('taxonomy_id', $categories);
        }

        if ($request->has('brands')) {
            $products->whereIn('brand_id', $request->brands);
        }

        $products = $products->paginate(6);

        if ($request->ajax()) {
            return view('tienda.product-list', compact('products'))->render();
        }


        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->get();

        $brands = Brand::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->get();

       
        return view('tienda.store',compact('categories','brands','products','business'));
    }

    public function ofertas(Request $request)
    {
        $business = Company::find(1);
        $products = Product::query()->where('stock', '>', 0)->where('liquidacion','=',1);       
        

        $products = $products->paginate(8);
        

        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->get();

        $brands = Brand::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->get();

       
        return view('tienda.ofertas',compact('categories','brands','products','business'));
    }

    public function buscar(Request $request)
    {
        $productos = Product::where('name', 'like', '%' . $request->nombre . '%')->get();

        return response()->json($productos);
    }

    public function detail (Product $product)
    {
        $business = Company::find(1);
        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->take(8)->get();

        $relatedProducts = Product::where('taxonomy_id', $product->taxonomy_id)
                          ->where('id', '!=', $product->id)
                          ->where('stock', '>', 0)
                          ->get();

        return view('tienda.product-detail', compact('product','categories','relatedProducts','business'));
    }

    public function about()
    {
        $business = Company::find(1);
        $nosotros = Field::find(1);
        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->take(8)->get();
        return view('about.index', compact('categories','business','nosotros'));
    }

    public function contact()
    {
        $business = Company::find(1);
        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->take(8)->get();

        return view('contact.index',compact('categories','business'));
    }

    public function reclamaciones()
    {
        $business = Company::find(1);
        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->take(8)->get();
        return view('general.libro-reclamaciones', compact('categories','business'));
    }

    // public function getColorImages($productId, $colorId)
    // {
    //     $images = \App\Models\ProductColorImage::where('product_id', $productId)
    //                 ->where('color_id', $colorId)
    //                 ->get();

        
    //     if ($images->isEmpty()) {
    //         $images = ProductColorImage::where('product_id', $productId)->get();
    //     }

    //     return response()->json($images);
    // }

    public function getColorImages($productId, $colorId = null)
    {
        // Buscar imágenes por color si existe colorId
        if ($colorId) {
            $images = ProductColorImage::where('product_id', $productId)
                        ->where('color_id', $colorId)
                        ->get();

            if ($images->isNotEmpty()) {
                return response()->json($images);
            }
        }

        // Si no hay color o no hay imágenes en product_color_images, traer imágenes del producto
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([]);
        }

        $images = $product->images ? json_decode($product->images) : [];

        return response()->json($images);
    }

    public function correoContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'file'    => 'nullable|file|max:2048', // hasta 2MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('attachments', 'public');
        }

        $correo = new Contactanos($request->all(), $filePath);
        try {
            Mail::to('informes@compactseguridad.com')->send($correo);
            return response()->json(['status' => true, 'msg' => "El correo fue enviado satisfactoriamente"]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => "Hubo un error al enviar, inténtalo de nuevo más tarde." . $e->getMessage()]);
        }
    }

    public function correoReclamo(Request $request)
    {
        $correo = new Reclamos($request);
        try {
            Mail::to('informes@compactseguridad.com')->send($correo);
            return response()->json(['status' => true, 'msg' => "El correo fue enviado satisfactoriamente"]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => "Hubo un error al enviar, inténtalo de nuevo más tarde." . $e->getMessage()]);
        }
    }
}
