<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

@extends('layouts.app')

@section('content')

@include('general.topbar')

<link href="{{asset('css/detail.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

<!-- Navbar Start -->
    <div class="container-fluid bg-mobil">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-naranja w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 50px; padding: 0 30px;">
                    <h6 class="text-white m-0">Categorías</h6>
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
            <div class="col-lg-6">
                <nav class="navbar navbar-expand-lg bg-mobil navbar-dark py-3 py-lg-0 px-0">
                    <a href="/" class="text-decoration-none d-block d-lg-none">
                        <img height="50" src="{{asset("storage/$business->image")}}" alt="">
                    </a>
                    <div class="row">
                        <!-- Lado derecho: Carrito -->
                        <a href="/cart" class="btn px-2 d-flex align-items-center sesion-destock">
                            <i class="fas fa-shopping-cart text-white"></i>
                            <span id="cartCount" class="badge text-white border border-secondary rounded-circle ml-1" style="padding-bottom: 2px;">
                                {{ \Cart::count() }}
                            </span>
                        </a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                        <div class="navbar-nav m-auto py-2 sesion-destock d-flex align-items-center justify-content-between w-100">    
                            <!-- Lado izquierdo: Usuario -->
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user text-white mr-2"></i>

                                @auth
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-white" href="#" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false">
                                        {{ auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                                        <li><a class="dropdown-item" href="#">Mis pedidos</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                @else
                                <a href="{{ url('login') }}" class="text-white">Iniciar sesión</a>
                                @endauth
                            </div>

                            
                        </div>

                        <div class="navbar-nav mr-auto py-0">
                            <a href="/" class="nav-item nav-link">Inicio</a>
                            <a href="/store" class="nav-item nav-link">Tienda</a>
                            <a href="/about" class="nav-item nav-link">Nosotros</a>
                            <a href="/contact" class="nav-item nav-link">Contáctanos</a>
                        </div>
                    </div>
                </nav>
                
            </div>
            <div class="col-lg-3 destock" style="position: absolute; right: 0;">
                <div id="promo-btn">
                    <a class="btn-promo btn-secondary" href="{{ route ('ofertas')}}">Ofertas</a>
                    <img src="{{asset('img/promo.png')}}" class="promo-tag swing">
                </div>
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
                <div class="carousel-inner bg-light" id="carousel-images">
                    @php
                        $colorImages = $product->colorImages;
                        $imagenesColor = collect();
                    @endphp

                    {{-- Caso 2: si el producto tiene registros en product_color_images --}}
                    @if($colorImages->count() > 0)
                        @php
                            if ($selectedColorId) {
                                // Mostrar imágenes del color seleccionado
                                $imagenesColor = $colorImages->where('color_id', $selectedColorId);
                            } else {
                                // Si no hay selección, tomar el primer color asociado al producto
                                $firstColor = $product->colors->first();
                                $imagenesColor = $firstColor
                                    ? $colorImages->where('color_id', $firstColor->id)
                                    : collect([]);
                            }
                        @endphp

                        @forelse($imagenesColor as $key => $item)
                            <div class="carousel-item @if($key==0) active @endif">
                                <div class="d-flex">
                                    <img class="m-auto" style="max-width: 500px;max-height: 500px;"
                                        src="{{ asset('storage/'.$item->image) }}" alt="Image">
                                </div>
                            </div>
                        @empty
                            <div class="carousel-item active">
                                <img class="w-100 h-100" src="{{asset('img/defectocompact.jpg')}}" alt="Image">
                            </div>
                        @endforelse

                    {{-- Caso 1: producto con imágenes iniciales en JSON --}}
                    @elseif($product->images)
                        @php
                            $imagenes = json_decode($product->images);
                        @endphp
                        @foreach($imagenes as $key => $item)
                            <div class="carousel-item @if($key==0) active @endif">
                                <div class="d-flex">
                                    <img class="m-auto" style="max-width: 500px;max-height: 500px;"
                                        src="{{ asset('storage/'.$item) }}" alt="Image">
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- fallback --}}
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{asset('img/defectocompact.jpg')}}" alt="Image">
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

        <div class="col-lg-7 h-auto mb-5">
            <div class="h-100 bg-light pt-5">                
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
                <div class="d-flex">
                    <strong class="text-dark me-3" style="width: 90px;">Categoría:</strong>
                    <label class="">{{$product->taxonomy->name}}</label>
                </div>
                <div class="d-flex align-items-center">
                    <strong class="text-dark mr-3" style="width: 70px;">Marca:</strong>
                    @if($product->brand->image)
                    <img src="{{asset('storage/' . $product->brand->image)}}" alt="" width="100">
                    @else
                    <label class="">{{$product->brand->name}}</label>
                    @endif
                </div>

                @if($product->colors->count() > 0)
                    <div class="d-block mb-3 align-items-center">
                        <strong class="text-dark mr-3 d-inline-block" style="width: 70px;">Colores:</strong>
                        @foreach($product->colors as $index => $color)
                            <label class="color-option mt-4">
                                <input type="radio" 
                                    name="color_id" 
                                    value="{{ $color->id }}" 
                                    data-product="{{ $product->id }}"
                                    @if($index === 0) checked @endif>
                                <span class="color-box" style="background-color: {{ $color->hex ?? '#ccc' }}"></span>
                            </label>
                        @endforeach
                    </div>
                    @endif
                
                @if($product->sizes->count()>0)
                <div class="d-block mb-4 align-items-center">
                    <strong class="text-dark mr-3 d-inline-block" style="width: 70px;">Tallas:</strong>
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

                <!-- Botón o link para abrir modal -->
                <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#medidasModal">
                   Ver medidas referenciales
                </a>

                <!-- Modal -->
                <div class="modal fade" id="medidasModal" tabindex="-1" aria-labelledby="medidasModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content border-0 bg-transparent">
                            
                            <div class="modal-body text-center p-0">
                                <!-- Imagen referencial -->
                                <img src="{{ asset('img/brochure.jpeg') }}" 
                                    alt="Medidas referenciales" 
                                    class="img-fluid rounded shadow-lg">

                                <!-- Botón cerrar -->
                                <button type="button" class="btn btn-primary position-absolute" style="right: 0; border-radius: 5px;" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4 pt-2">
                    <!-- <div class="row"> -->
                        <div class="my-2">
                            <div class="input-group quantity1 mr-3" style="width: 130px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control bg-secondary border-0 text-center" value="1" id="qty">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-plus1">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="my-2 w-100">
                            <a href="#" class="btn btn-primary px-3 addcart" data-id="{{$product->id}}">
                                <i class="fa fa-shopping-cart mr-1"></i> 
                                Agregar al carrito
                            </a>
                        </div>
                    <!-- </div> -->
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Compartir en:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="https://www.instagram.com/?url={{ urlencode(url()->current()) }}" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-dark px-2" href="https://www.tiktok.com/url={{ urlencode(url()->current()) }}" target="_blank">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        

        
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light">
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
    <div class="px-xl-5">
        <h2 class="section-title position-relative text-uppercase px-3"><span>También te puede interesar</span></h2>
        <div class="row">
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
                            <img class="img-fluid w-100" src="{{asset ('img/defectocompact.jpg')}}" alt=""
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{asset('js/detail.js')}}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- <script src="{{asset('js/addcart.js')}}"></script> -->

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
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const radios = document.querySelectorAll("input[name='color_id']");
            const selectedColor = document.getElementById("selected-color");

            radios.forEach(radio => {
                radio.addEventListener("change", function() {
                    selectedColor.textContent = "Color seleccionado: " + this.dataset.name;
                });
            });
        });
    </script> -->

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const colorInputs = document.querySelectorAll('input[name="color_id"]');
        const carouselInner = document.querySelector('.carousel-inner');

        function updateCarousel(images) {
            carouselInner.innerHTML = '';

            images.forEach((imgObj, index) => {
                const src = imgObj.image ? imgObj.image : imgObj; // si es objeto o string
                const itemDiv = document.createElement('div');
                itemDiv.className = index === 0 ? 'carousel-item active' : 'carousel-item';

                const img = document.createElement('img');
                img.src = '/storage/' + src;
                img.style.maxWidth = '500px';
                img.style.maxHeight = '500px';
                img.className = 'm-auto';

                itemDiv.appendChild(img);
                carouselInner.appendChild(itemDiv);
            });
        }

       
        // Evento para cambio de color
        colorInputs.forEach(input => {
            input.addEventListener('change', async function() {
                const productId = this.dataset.product;
                const colorId = this.value;

                try {
                    const res = await fetch(`/products/${productId}/color/${colorId}/images`);
                    if (!res.ok) throw new Error('Error al obtener imágenes');
                    const images = await res.json();

                    // Si no hay imágenes de color, usar las del producto
                    if (!images.length) {
                        const productImages = @json($product->images ? json_decode($product->images) : []);
                        updateCarousel(productImages);
                    } else {
                        updateCarousel(images);
                    }

                } catch (err) {
                    console.error(err);
                    // updateCarousel(productImages);
                }
            });
        });
    });
    </script>
    
    
@endpush

@endsection