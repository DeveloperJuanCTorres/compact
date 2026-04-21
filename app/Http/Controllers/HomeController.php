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
use App\Models\Subtaxonomy;
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
        $subcategories = Subtaxonomy::all();
        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->take(8)->get();

        $brands = Brand::all();
        $video = Field::value('video_educativo');


        $banners = Banner::all();
        $products = Product::where('stock', '>', 0)->take(8)->get();

        return view('home.index', compact('business','categories','banners','products','brands','video','subcategories'));
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
        $search = $request->input('search');
        $business = Company::find(1);
        $products = Product::query()->where('stock', '>', 0)
                    ->where('liquidacion','!=', 1)
                    ->where('name', 'like', "%{$search}%");

       
        if ($request->filled('categories')) {
            $categories = is_array($request->categories) 
                ? $request->categories 
                : [$request->categories];

            $products->whereIn('taxonomy_id', $categories);
        }

        if ($request->filled('subcategories')) {
            $subcategories = is_array($request->subcategories) 
                ? $request->subcategories 
                : [$request->subcategories];

            $products->whereIn('subtaxonomy_id', $subcategories);
        }


        if ($request->filled('brands')) {
            $brands = is_array($request->brands)
                ? $request->brands
                : [$request->brands];

            $products->whereIn('brand_id', $brands);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $products->where('name', 'like', "%{$search}%");
        }

        $products = $products->paginate(6);

        if ($request->ajax()) {
            return view('tienda.product-list', compact('products'))->render();
        }


        // $categories = Taxonomy::whereHas('products', function ($query) {
        //     $query->where('stock', '>', 0);
        // })->get();

        //  $subcategories = Subtaxonomy::whereHas('products', function ($query) {
        //     $query->where('stock', '>', 0);
        // })->get();

        $categories = Taxonomy::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->get();

        // Si se seleccionó una categoría, filtra las subcategorías de esa categoría
        if ($request->filled('categories')) {
            $categoryId = is_array($request->categories) ? $request->categories[0] : $request->categories;
            
            $subcategories = Subtaxonomy::where('taxonomy_id', $categoryId)
                ->whereHas('products', function ($query) {
                    $query->where('stock', '>', 0);
                })
                ->get();
        } else {
            // Si no hay categoría seleccionada, mostrar todas las subcategorías disponibles
            $subcategories = Subtaxonomy::whereHas('products', function ($query) {
                $query->where('stock', '>', 0);
            })->get();
        }


        $brands = Brand::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->get();

       
        return view('tienda.store',compact('categories', 'subcategories','brands','products','business'));
    }

    public function getSubcategories($categoryId)
    {
        if ($categoryId === 'all') {
            // 🔹 Traer TODAS las subcategorías con productos en stock
            $subcategories = Subtaxonomy::whereHas('products', function ($query) {
                    $query->where('stock', '>', 0);
                })
                ->withCount(['products as products_in_stock_count' => function ($query) {
                    $query->where('stock', '>', 0);
                }])
                ->get(['id', 'name']);
        } else {
            // 🔹 Traer solo las subcategorías de la categoría seleccionada
            $subcategories = Subtaxonomy::where('taxonomy_id', $categoryId)
                ->whereHas('products', function ($query) {
                    $query->where('stock', '>', 0);
                })
                ->withCount(['products as products_in_stock_count' => function ($query) {
                    $query->where('stock', '>', 0);
                }])
                ->get(['id', 'name']);
        }

        return response()->json($subcategories);
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

        $banner = Banner::where('oferta', 1)->first();

       
        return view('tienda.ofertas',compact('categories','brands','products','business','banner'));
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

        // Capturamos el color seleccionado (si existe en la request)
        $selectedColorId = request()->get('color_id');

        return view('tienda.product-detail', compact('product','categories','relatedProducts','business', 'selectedColorId'));
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

    // public function colorImages(Product $product, $colorId)
    // {
    //     $imagenesColor = $product->colorImages()
    //         ->where('color_id', $colorId)
    //         ->where('product_id', $product->id) // 👈 aseguras que es del producto
    //         ->get();

    //     if ($imagenesColor->isEmpty()) {
    //         // si no hay imágenes de color, devolvemos las del producto (tabla products.images)
    //         $imagenes = $product->images ? json_decode($product->images) : [];
    //         return response()->json($imagenes);
    //     }

    //     return response()->json(
    //         $imagenesColor->map(fn($img) => ['image' => $img->image])
    //     );
    // }

    
    public function getColorImages($productId, $colorId = null)
    {
       
        if ($colorId) {
            $images = ProductColorImage::where('product_id', $productId)
                        ->where('color_id', $colorId)
                        ->get();

            if ($images->isNotEmpty()) {
                return response()->json($images);
            }
        }

       
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
            'mensaje' => 'required|string',
            'file'    => 'nullable|file|max:2048', // hasta 2MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('attachments', 'public');
        }

        $correo = new Contactanos($request->all(), $filePath);
        try {
            Mail::to('contactanos@compactseguridad.com')->send($correo);
            return response()->json(['status' => true, 'msg' => "El correo fue enviado satisfactoriamente"]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => "Hubo un error al enviar, inténtalo de nuevo más tarde." . $e->getMessage()]);
        }
    }

    public function correoReclamo(Request $request)
    {
        $correo = new Reclamos($request);
        try {
            Mail::to('reclamos@compactseguridad.com')->send($correo);
            return response()->json(['status' => true, 'msg' => "El correo fue enviado satisfactoriamente"]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => "Hubo un error al enviar, inténtalo de nuevo más tarde." . $e->getMessage()]);
        }
    }
}
