@extends('layouts.app')

@section('content')

@include('general.topbar')

<link href="{{asset('css/detail.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

<!-- Navbar Start -->
    <div class="container-fluid bg-mobil sticky-top">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-naranja w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 50px; padding: 0 30px;">
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
                            <a href="/" class="nav-item nav-link">Inicio</a>
                            <a href="/store" class="nav-item nav-link">Tienda</a>
                            <a href="/about" class="nav-item nav-link">Nosotros</a>
                            <a href="/contact" class="nav-item nav-link">Contáctanos</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Navbar End -->

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="/">Inicio</a>
                <span class="breadcrumb-item active">Detalle del producto</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    @php
                        $imagenes = json_decode($product->images)
                    @endphp
                    
                    @if($imagenes)
                        @foreach($imagenes as $key => $item)
                        @if($key == 0)
                        <div class="carousel-item active">
                            <img style="max-width: 500px;max-height: 500px;" src="{{asset('storage/' . $item)}}" alt="Image">
                        </div>
                        @else
                        <div class="carousel-item">
                            <img style="max-width: 500px;max-height: 500px;" src="{{asset('storage/' . $item)}}" alt="Image">
                        </div>
                        @endif
                        @endforeach
                    @else
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{asset('img/defectomaster.jpeg')}}" alt="Image">
                    </div>
                    @endif
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{$product->name}}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(99 Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">S/. {{$product->price}}</h3>
                @php
                    $descripcion = $product->description;
                    $limit = 150;
                @endphp
                <p class="mb-4">
                    <span id="short-{{ $product->id }}">
                        {{ Str::limit($descripcion, $limit, '...') }}
                        @if(strlen($descripcion) > $limit)
                            <a href="javascript:void(0)" class="text-primary ver-mas" 
                            data-id="{{ $product->id }}">Ver más</a>
                        @endif
                    </span>
                    @if(strlen($descripcion) > $limit)
                        <span id="full-{{ $product->id }}" style="display: none;">
                            {{ $descripcion }}
                            <a href="javascript:void(0)" class="text-primary ver-menos" 
                            data-id="{{ $product->id }}">Ver menos</a>
                        </span>
                    @endif                    
                </p>
                <div class="d-flex mb-3">
                    <strong class="text-dark mr-3">Categría:</strong>
                    <label class="">{{$product->taxonomy->name}}</label>
                </div>
                <div class="d-flex mb-4">
                    <strong class="text-dark mr-3">Marca:</strong>
                    <label class="">{{$product->brand->name}}</label>
                </div>

                @if($product->colors->count()>0)
                <div class="d-flex mb-3">
                    <strong class="text-dark mr-3">Colores:</strong>
                     @foreach($product->colors as $index => $color)
                        <label class="color-option mr-2">
                            <input type="radio" 
                                name="color_id" 
                                value="{{ $color->id }}" 
                                data-name="{{ $color->name }}"
                                @if($index === 0) checked @endif>
                            <span class="color-box" style="background-color: {{ $color->hex ?? '#ccc' }}"></span>
                        </label>
                    @endforeach
                </div>
                <!-- <div id="selected-color" class="mt-2 text-primary fw-bold"></div> -->
                @endif

                @if($product->sizes->count()>0)
                <div class="d-flex mb-3">
                    <strong class="text-dark mr-3">Tallas: <span id="talla"></span></strong>
                    @foreach($product->sizes as $index => $size)
                        <label class="color-option mr-2">
                            <input type="radio" 
                                name="size_id" 
                                value="{{ $size->id }}" 
                                data-name="{{ $size->talla }}"
                                @if($index === 0) checked @endif>
                            <span class="color-box text-center pt-1">{{$size->talla}}</span>
                        </label>
                    @endforeach
                </div>
                @endif

                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="row">
                        <div class="col-md-6 col-12 my-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control bg-secondary border-0 text-center" value="1" id="qty">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 my-2">
                            <a href="#" class="btn btn-primary px-3 addcart" data-id="{{$product->id}}">
                                <i class="fa fa-shopping-cart mr-1"></i> 
                                Agregar al carrito
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Compartir en:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
    <div class="row">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                    <!-- <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a> -->
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Descripción del Producto</h4>
                        <p>{{$product->description}}</p>

                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Información Adicional</h4>
                        @if($product->information)
                        <p>{!! Str::markdown($product->information) !!}</p>    
                        @endif                    
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">1 review for "Product Name"</h4>
                                <div class="media mb-4">
                                    <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-primary">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Your Name *</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->
 
<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="pr-3">También te puede interesar</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach($relatedProducts as $product)
                    <div class="product-item bg-light mb-4" style="border: 1px solid #ddd;border-radius: 10px;">
                        <div class="product-img position-relative overflow-hidden"
                            style="aspect-ratio: 1 / 1; border-radius: 10px; overflow: hidden;">
                            @php
                                $imagenes = json_decode($product->images)
                            @endphp
                            @if($imagenes)
                            <img class="img-fluid w-100" src="{{asset('storage/' . $imagenes[0])}}" alt=""
                                style="width:100%; height:100%; object-fit:cover;">
                            @else
                            <img class="img-fluid w-100" src="img/defectomaster.jpeg" alt=""
                                style="width:100%; height:100%; object-fit:cover;">
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
                            <a class="h6 text-decoration-none text-truncate" href="{{route('product.detail', $product)}}">{{ Str::limit($product->name, 30, '...') }}</a>
                            <div class="d-flex mt-2">
                                <h5>S/. {{$product->price}}</h5><h6 class="text-muted ml-2"><del>S/. {{$product->price*1.20}}</del></h6>
                            </div>  
                            <a class="btn btn-primary addcart w-100" href="javascript:void(0)" data-id="{{$product->id}}">
                                <i class="fa fa-shopping-cart"></i>
                                Agregar al carrito
                            </a>               
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->

@include('general.footer')

@push('scripts')
    <script src="{{asset('js/detail.js')}}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="{{asset('js/addcart.js')}}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".ver-mas").forEach(btn => {
                btn.addEventListener("click", function () {
                    let id = this.dataset.id;
                    document.getElementById("short-" + id).style.display = "none";
                    document.getElementById("full-" + id).style.display = "inline";
                });
            });

            document.querySelectorAll(".ver-menos").forEach(btn => {
                btn.addEventListener("click", function () {
                    let id = this.dataset.id;
                    document.getElementById("short-" + id).style.display = "inline";
                    document.getElementById("full-" + id).style.display = "none";
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const radios = document.querySelectorAll("input[name='color_id']");
            const selectedColor = document.getElementById("selected-color");

            radios.forEach(radio => {
                radio.addEventListener("change", function() {
                    selectedColor.textContent = "Color seleccionado: " + this.dataset.name;
                });
            });
        });
    </script>
    
@endpush

@endsection