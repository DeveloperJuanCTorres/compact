@extends('layouts.app')

@section('content')

@include('general.topbar')

<!-- Navbar Start -->
<div class="container-fluid bg-mobil">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-footer w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 50px; padding: 0 30px;">
                <h6 class="text-white m-0"><i class="fa fa-bars mr-2"></i>Categorías</h6>
                <i class="fa fa-angle-down text-white"></i>
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
            <nav class="navbar navbar-expand-lg bg-mobil navbar-dark py-3 py-lg-0 px-0">
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
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->


<!-- Carousel Start -->
<div class="container-carrusel mb-3">
    <div class="row">
        <div class="col-lg-12" style="padding-left: 0; padding-right: 0;">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#header-carousel" data-slide-to="1"></li>
                    <li data-target="#header-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach($banners as $key => $banner)
                        @if($key == 1)
                        <div class="carousel-item position-relative active" style="height: 480px;">
                            <img class="position-absolute w-100 h-100" src="storage/{{$banner->image}}" style="object-fit: cover;">
                            
                        </div>
                        @else
                        <div class="carousel-item position-relative" style="height: 480px;">
                            <img class="position-absolute w-100 h-100" src="storage/{{$banner->image}}" style="object-fit: cover;">
                            
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>        
    </div>
</div>
<!-- Carousel End -->


<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="align-items-center mb-4 text-center" >
                <h3 class="fa fa-tags text-primary m-0 mr-3 mb-2"></h3>
                <h6 class="font-weight-semi-bold m-0">LAS MEJORES OFERTAS</h6>
                <span>En todas nuestras líneas</span>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="align-items-center bg-light mb-4 text-center">
                <h3 class="fa fa-lock text-primary m-0 mr-2 mb-2"></h3>
                <h6 class="font-weight-semi-bold m-0">TODO EN SEGURIDAD</h6>
                <span>El mejor equipamiento</span>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="align-items-center bg-light mb-4 text-center">
                <h3 class="fas fa-truck text-primary m-0 mr-3 mb-2"></h3>
                <h6 class="font-weight-semi-bold m-0">LLEGAMOS A TODO EL PERÚ</h6>
                <span>Donde tú estás</span>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="align-items-center bg-light mb-4 text-center">
                <h3 class="fa fa-lock text-primary m-0 mr-3"></h3>
                <h6 class="font-weight-semi-bold m-0">PAGO SEGURO</h6>
                <span>Siempre preocupados</span>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->

<!-- Categories Start -->
    @include('general.categorias')  
<!-- Categories End -->

<!-- Vendor Start -->
<div class="container-fluid py-5">
    <h3 class="text-center">Marcas asociadas</h3>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                @foreach($brands as $key => $brand)
                <div class="bg-light p-4">
                    <img src="storage/{{$brand->image}}" alt="">
                </div> 
                @endforeach               
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->

<!-- brochure Start -->
<div class="container-fluid bg-footer text-secondary ">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-2"></div>
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5 my-auto">
           <h4 class="text-white">Descarga Nuestro</h4>
           <h4 class="text-primary">Catálogo Digital 2025</h4>
           <span style="font-size: 12px;">Accede a nuestra completa gama de productos de seguridad industrial y equipamiento profesional en un solo documento.</span>
           <br><br>           
           <div class="d-flex align-items-center">
                <div class="icon-circle me-3">
                    <i class="fas fa-mobile"></i>
                </div>
                <div class="d-flex flex-column px-4">
                    <span class="fw-bold" style="font-size: 12px;">Acceso Multiplataforma</span>
                    <span class="text-muted" style="font-size: 12px;">Compatible con todos tus dispositivos</span>
                </div>
            </div>
            <div class="d-flex align-items-center pt-2">
                <div class="icon-circle me-3">
                    <i class="fas fa-retweet" aria-hidden="true"></i>
                </div>
                <div class="d-flex flex-column px-4">
                    <span class="fw-bold" style="font-size: 12px;">Siempre Actualizado</span>
                    <span class="text-muted" style="font-size: 12px;">Precios y especificaciones al día</span>
                </div>
            </div>
            <div class="d-flex align-items-center pt-2">
                <div class="icon-circle me-3">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <div class="d-flex flex-column px-4">
                    <span class="fw-bold" style="font-size: 12px;">Fichas Técnicas</span>
                    <span class="text-muted" style="font-size: 12px;">Información detallada de cada producto</span>
                </div>
            </div>
            <a href="" class="btn btn-primary my-4">
                Descargar Catálogo
                <i class="fa fa-download" aria-hidden="true"></i>
            </a>
        </div>
        
        <div class="col-lg-4 col-md-12 pb-4">
            <div class="d-block m-auto">
                <img style="height: 400px; border-radius: 10px;" src="img/brochure.jpeg" alt="">
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>
<!-- brochure End -->

<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="text-center pb-4">
        <h3>Productos Destacados</h3>
        <span>Nuestra selección especial de productos destacados</span>
    </div>
    
    <div class="row px-xl-5">
        @foreach($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4" style="border: 1px solid #ddd;border-radius: 10px;">
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
                        <a class="btn btn-outline-dark" href="{{route('product.detail', $product)}}">
                            Detalle del producto
                            <i class="fa fa-search"></i>                            
                        </a>
                    </div>
                </div>
                <div class="px-4 py-4">
                    <div class="d-flex  mb-1">
                        <small class="text-muted" style="font-size: 12px;">{{$product->taxonomy->name}}</small>
                    </div>
                    <a class="h6 text-decoration-none text-truncate" href="{{route('product.detail', $product)}}">{{$product->name}}</a>
                    <div class="d-flex mt-2">
                        <h5>S/. {{$product->price}}</h5><h6 class="text-muted ml-2"><del>S/. {{$product->price*1.20}}</del></h6>
                    </div>  
                    <a class="btn btn-primary addcart w-100" href="javascript:void(0)" data-id="{{$product->id}}">
                        <i class="fa fa-shopping-cart"></i>
                        Agregar al carrito
                    </a>               
                </div>
            </div>
        </div>
        @endforeach        
    </div>    
    <div class="row px-xl-5">
        <div class="d-block m-auto">
            <a href="/store" class="btn btn-primary py-2 px-4" style="border-radius: 10px;">Ver todos los productos</a>
        </div>
    </div>
</div>
<!-- Products End -->

@include('general.reseñas')

<!-- Seccion de videos -->
<div class="container-fluid pt-5">
    <div class="text-center pb-4 d-block m-auto" style="max-width: 500px;">
        <h3 class="">Videos Educativos</h3>
        <span>Descubre consejos, tutoriales y mejores prácticas sobre seguridad industrial a través de nuestro contenido en YouTube</span>
    </div>

    <div >
        <iframe class="d-block m-auto video" style="border-radius: 10px;" src="https://www.youtube.com/embed/SBYgBVoaDto?si=OAxjoehHdpUkvarY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
    <div class="text-center pt-4">
        <a class="btn btn-primary" href="https://www.youtube.com/@compact.estudios" target="_blank">
            <i class="fa fa-youtube-play text-white" aria-hidden="true"></i>
            Suscribete a nuestro canal
        </a> 
    </div>
</div>
<!-- fin de seccion de videos -->

@include('general.footer')

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/addcart.js"></script>
<script>
    const baseUrl = "{{ url('/product.detail') }}"; // Esto será "/producto"
</script>
@endpush

@endsection
