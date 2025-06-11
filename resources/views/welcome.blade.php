@extends('layouts.app')

@section('content')

@include('partials.topbar')

<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categorías</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">          
                    @foreach($categories as $category)          
                    <a href="{{ route('store', ['categories' => $category->id]) }}" class="nav-item nav-link">{{$category->name}}</a>
                    @endforeach
                    <a href="/store" class="btn btn-primary py-2 px-4 m-2" style="border-radius: 10px;">Más categorías</a>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <img height="50" src="{{asset("storage/$business->image")}}" alt="">
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="/" class="nav-item nav-link active">Inicio</a>
                        <a href="/store" class="nav-item nav-link">Tienda</a>
                        <a href="/about" class="nav-item nav-link">Nosotros</a>
                        <a href="/contact" class="nav-item nav-link">Contáctanos</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-lg-block">
                        <a href="/cart" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span id="cartCount" class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                                {{\Cart::count()}}
                            </span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->


<!-- Carousel Start -->
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#header-carousel" data-slide-to="1"></li>
                    <li data-target="#header-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach($banners as $key => $banner)
                        @if($key == 1)
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="storage/{{$banner->image}}" style="object-fit: cover;">
                            
                        </div>
                        @else
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="storage/{{$banner->image}}" style="object-fit: cover;">
                            
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            @foreach($promotions as $promotion)
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="storage/{{$promotion->image}}" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">{{$promotion->titulo}}</h6>
                    <h3 class="text-white mb-3">{{$promotion->description}}</h3>
                    <h6 class="text-white text-uppercase">Ahorre un 20%</h6>
                    <h3 class="text-white mb-3">Oferta especial</h3>
                    <a href="" class="btn btn-primary" style="border-radius: 10px;">Comprar ahora</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Carousel End -->


<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Productos de calidad</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Envío gratis</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Devolucion en 14 días</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Soporte 24/7</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categorías</span></h2>
    <div class="row px-xl-5 pb-3">
        @foreach($categories as $category)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="{{ route('store', ['categories' => $category->id]) }}">
                <div class="cat-item d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        @if($category->image)
                        <img class="img-fluid" src="storage/{{$category->image}}" alt="">
                        @else
                        <img class="img-fluid" src="img/defectomaster.jpeg" alt="">
                        @endif
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>{{$category->name}}</h6>
                        <small class="text-body">{{$category->productsInStock->count()}} productos</small>
                    </div>
                </div>
            </a>
        </div>
        @endforeach        
    </div>
    <div class="row px-xl-5 pb-3">
        <div class="d-block m-auto">
            <a href="/store" class="btn btn-primary py-2 px-4" style="border-radius: 10px;">Más categorías</a>
        </div>
    </div>
</div>
<!-- Categories End -->


<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Nuestros productos</span></h2>
    <div class="row px-xl-5">
        @foreach($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    @php
                        $imagenes = json_decode($product->images)
                    @endphp
                    @if($imagenes)
                    <img class="img-fluid w-100" src="storage/{{$imagenes[0]}}" alt="">
                    @else
                    <img class="img-fluid w-100" src="img/defectomaster.jpeg" alt="">
                    @endif
                    <div class="product-action">
                        <input type="hidden" id="qty" value="1">
                        <a class="btn btn-outline-dark addcart" href="javascript:void(0)" data-id="{{$product->id}}">
                            <i class="fa fa-shopping-cart"></i>
                            Agregar al carrito
                        </a>
                        <a class="btn btn-outline-dark" href="{{route('product.detail', $product)}}">
                            <i class="fa fa-search"></i>
                        </a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="{{route('product.detail', $product)}}">{{$product->name}}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>S/. {{$product->price}}</h5><h6 class="text-muted ml-2"><del>S/. {{$product->price*1.20}}</del></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small>Stock ({{$product->stock}} {{$product->unidad_medida}})</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach        
    </div>    
    <div class="row px-xl-5">
        <div class="d-block m-auto">
            <a href="/store" class="btn btn-primary py-2 px-4" style="border-radius: 10px;">Más productos</a>
        </div>
    </div>
</div>
<!-- Products End -->


<!-- Offer Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        @foreach($promotions as $promotion)
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="storage/{{$promotion->image}}" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Ahorre un 20%</h6>
                    <h3 class="text-white mb-3">Oferta especial</h3>
                    <a href="" class="btn btn-primary" style="border-radius: 10px;">Comprar ahora</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Offer End -->


<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4">
                    <img src="img/vendor-1.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-2.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-3.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-4.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-5.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-6.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-7.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-8.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->

@include('partials.footer')

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/addcart.js"></script>
<script>
    const baseUrl = "{{ url('/product.detail') }}"; // Esto será "/producto"
</script>
@endpush

@endsection
