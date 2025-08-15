<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Field;
use App\Models\Product;
use App\Models\Taxonomy;
use Illuminate\Http\Request;

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

        $banners = Banner::all();
        $products = Product::where('stock', '>', 0)->take(8)->get();

        return view('home.index', compact('business','categories','banners','products','brands'));
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
        $products = Product::query()->where('stock', '>', 0);

       
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
}
