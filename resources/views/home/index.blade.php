@extends('layouts.app')

@section('content')

@include('general.topbar')




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
                    <a href="" class="text-decoration-none d-block d-lg-none">
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
                            <a href="/" class="nav-item nav-link active">Inicio</a>
                            <a href="/store" class="nav-item nav-link">Tienda</a>
                            <a href="/about" class="nav-item nav-link">Nosotros</a>
                            <a href="/contact" class="nav-item nav-link">Contáctanos</a>
                            
                        </div>

                        <a href="{{ route('catalogo.index') }}" target="_blank" class="btn btn-primary">
                            Descargar Catálogo
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </a>
                    </div>
                </nav>
                
            </div>
            <div class="col-lg-3 destock" style="position: absolute; right: 0;">
                <div id="promo-btn">
                    <a class="btn-promo btn-secondary" href="{{ route ('ofertas')}}">Ofertas</a>
                    <img src="img/promo.png" class="promo-tag swing">
                </div>
            </div>
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
                    @foreach($banners as $key => $banner)
                        <li data-target="#header-carousel" data-slide-to="{{$key}}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($banners as $key => $banner)
                        <div class="carousel-item position-relative {{ $key == 0 ? 'active' : '' }}">
                            <!-- Imagen -->
                            <img class="d-block w-100" src="storage/{{$banner->image}}"  
                                 style="max-width: 100%; max-height: 100vh; object-fit: cover;">

                            <!-- Capa semitransparente -->
                            <div class="overlay"></div>

                            <!-- Íconos superpuestos con texto -->
                            <div class="carousel-icons iconos-mobil">
                                <!-- <div class="icon-box">
                                    <i class="fas fa-tags"></i>
                                    <span class="font-weight-bold">LAS MEJORES OFERTAS</span>
                                </div>
                                <div class="icon-box">
                                    <i class="fas fa-shield-alt"></i>
                                    <span class="font-weight-bold">TODO EN SEGURIDAD</span>
                                </div> -->
                                <div class="icon-box">
                                    <i class="fas fa-credit-card"></i>
                                    <span class="font-weight-bold">PAGO SEGURO</span>
                                </div>
                                <div class="icon-box">
                                    <i class="fas fa-truck"></i>
                                    <span class="font-weight-bold">ENVÍOS A TODO EL PERÚ</span>
                                </div>                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>        
    </div>
</div>
<!-- Carousel End -->


<div class="container-fluid py-5">
    <div class="text-center py-5">
        <h3>¿Qué tipo de implemento de Seguridad estás buscando?</h3>
        <span>Encuentra el quipo de protección que necesitas para tu seguridad laboral</span>
    </div>
    <div class="row px-xl-5">        
        <div class="carousel-container">
            <div class="carousel1">
                @foreach($subcategories as $key => $subcategory)
                <div class="carousel-item1">
                    @if($subcategory->image)
                    <img src="storage/{{$subcategory->image}}" alt="{{$subcategory->name}}">
                    @else
                    <img src="img/iconodefecto1.png" alt="{{$subcategory->name}}">
                    @endif
                    <div class="d-flex align-items-center justify-content-center m-auto" style="height: 100px;">
                        <h4>{{$subcategory->name}}</h4>
                    </div>
                    <!-- <p>Ceci est une description courte pour la carte 1.</p> -->
                    <a class="btn btn-primary mt-2" style="border-radius: 10px;" href="{{ route('store', ['subcategories' => $subcategory->id]) }}" title="productos">Ver productos</a>
                </div>
                @endforeach
            </div>
            <div class="carousel-controls">
                <!-- <button class="carousel-control prev" onclick="prevSlide()">&#10094;</button>
                <button class="carousel-control next" onclick="nextSlide()">&#10095;</button> -->
            </div>
        </div>
    </div>
</div>

<!-- Categories Start -->
    <!-- include('general.categorias')   -->
<!-- Categories End -->

<!-- Vendor Start -->
<div class="container-fluid py-5">
    <h3 class="text-center">Marcas asociadas</h3>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                @foreach($brands as $key => $brand)
                    @if($brand->image)
                    <div class="bg-light p-4">
                        <img src="storage/{{$brand->image}}" alt="">
                    </div>
                    @endif 
                @endforeach               
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->

<!-- Featured Start -->
<div class="container-fluid iconos-destock">
    <div class="row px-xl-5 pb-3 m-auto">
        <!-- <div class="col-6 pt-4">
            <div class="icon-box">
                <i class="fas fa-tags"></i>
                <h6 class="font-weight-semi-bold m-0">LAS MEJORES OFERTAS</h6>
            </div>
        </div>
        <div class="col-6 pt-4">
            <div class="icon-box">
                <i class="fas fa-shield-alt"></i>
                <h6 class="font-weight-semi-bold m-0">TODO EN SEGURIDAD</h6>
            </div>
        </div> -->
        <div class="col-6 pt-2">
            <div class="icon-box">
                <i class="fas fa-credit-card"></i>
                <h6 class="font-weight-semi-bold m-0">Pago Seguro</h6>
            </div>
        </div>
        <div class="col-6 pt-2">
            <div class="icon-box">
                <i class="fas fa-truck"></i>
                <h6 class="font-weight-semi-bold m-0">Envíos a todo el Perú</h6>
            </div>
        </div>        
    </div>
</div>
<!-- Featured End -->

<!-- brochure Start -->
<!-- <div class="container-fluid bg-mobil text-secondary ">
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
</div> -->
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
                <div class="product-img position-relative overflow-hidden"
                    style="aspect-ratio: 1 / 1; border-radius: 10px; overflow: hidden;">
                    @php
                        $imagenes = json_decode($product->images)
                    @endphp
                    @if($imagenes)
                    <img class="img-fluid w-100" src="storage/{{$imagenes[0]}}" alt=""
                        style="width:100%; height:100%; object-fit:cover;">
                    @else
                    <img class="img-fluid w-100" src="img/defectocompact.jpg" alt=""
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

<!-- include('general.reseñas') -->

<!-- Seccion de videos -->
 <section class="social-videos py-5">
    <div class="container">

        <div class="text-center mb-4">
            <h2 class="fw-bold">Síguenos en Redes</h2>
            <p class="text-muted">Mira nuestros últimos videos</p>
        </div>

        <div class="row g-4">

            <!-- Facebook -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="video-card">
                    <div class="video-wrapper">
                        <iframe 
                        src="https://www.facebook.com/plugins/video.php?height=476&href=https%3A%2F%2Fwww.facebook.com%2Freel%2F759818153445432%2F&show_text=false&width=267&t=0"
                        width="100%" height="100%" 
                        style="border:none;overflow:hidden"
                        scrolling="no" frameborder="0"
                        allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Instagram -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="video-card">
                    <blockquote 
                        class="instagram-media"
                        data-instgrm-permalink="https://www.instagram.com/reel/DRPePW-jssI/"
                        data-instgrm-version="14">
                    </blockquote>
                </div>
            </div>

            <!-- TikTok -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="video-card">
                    <blockquote class="tiktok-embed"
                        cite="https://www.tiktok.com/@compact.epp/video/7572997634160397576"
                        data-video-id="7572997634160397576">
                        <section></section>
                    </blockquote>
                </div>
            </div>

        </div>
    </div>
</section>

<div class="container-fluid pt-5">
    <div class="text-center pb-4 d-block m-auto" style="max-width: 500px;">
        <h3 class="">Videos Educativos</h3>
        <span>Descubre nuestras novedades y ofertas exclusivas a través de nuestro contenido en redes</span>
    </div>

    <div >
        <iframe class="d-block m-auto video" style="border-radius: 10px;" src="{{$video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
    <div class="text-center pt-4">
        <a class="btn btn-primary" href="{{$business->redes_link}}" target="_blank">
            <i class="fa fa-youtube-play text-white" aria-hidden="true"></i>
            Siguenos en nuestras redes
        </a> 
    </div>
    <!-- <div class="row pt-5">
        <div class="col-lg-4 col-md-6 col-12">
            <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@grupotyg_ing/video/7297846035320245510" data-video-id="7297846035320245510" style="max-width: 605px;min-width: 325px;" > <section> <a target="_blank" title="@grupotyg_ing" href="https://www.tiktok.com/@grupotyg_ing?refer=embed">@grupotyg_ing</a> Estimada red, si estás en busca de alguno de estos servicios: ▪️Diseño Web ▪️Desarrollo Web ▪️Business Intelligence ▪️Branding  GRUPO T&#38;G es tu mejor opción 📲 Cotiza tu proyecto ahora!! 🥳🙌 Contáctanos al: +51 978 209 130 Visita nuestra página web:  🔗www.grupotyg.pe  <a title="desarrolloweb" target="_blank" href="https://www.tiktok.com/tag/desarrolloweb?refer=embed">#desarrolloweb</a> <a title="web" target="_blank" href="https://www.tiktok.com/tag/web?refer=embed">#web</a> <a title="ti" target="_blank" href="https://www.tiktok.com/tag/ti?refer=embed">#ti</a> <a title="ecommerce" target="_blank" href="https://www.tiktok.com/tag/ecommerce?refer=embed">#ecommerce</a> <a title="paginaweb" target="_blank" href="https://www.tiktok.com/tag/paginaweb?refer=embed">#paginaweb</a> <a title="webdeveloper" target="_blank" href="https://www.tiktok.com/tag/webdeveloper?refer=embed">#webdeveloper</a> <a title="website" target="_blank" href="https://www.tiktok.com/tag/website?refer=embed">#website</a> <a title="dashboard" target="_blank" href="https://www.tiktok.com/tag/dashboard?refer=embed">#dashboard</a> <a title="analisisdedatos" target="_blank" href="https://www.tiktok.com/tag/analisisdedatos?refer=embed">#analisisdedatos</a> <a title="inteligenciadenegocios" target="_blank" href="https://www.tiktok.com/tag/inteligenciadenegocios?refer=embed">#inteligenciadenegocios</a> <a title="powerbi" target="_blank" href="https://www.tiktok.com/tag/powerbi?refer=embed">#PowerBI</a> <a title="businessintelligence" target="_blank" href="https://www.tiktok.com/tag/businessintelligence?refer=embed">#businessintelligence</a> <a title="business" target="_blank" href="https://www.tiktok.com/tag/business?refer=embed">#business</a> <a title="dataanalytics" target="_blank" href="https://www.tiktok.com/tag/dataanalytics?refer=embed">#dataanalytics</a> <a target="_blank" title="♬ Sunrise - Official Sound Studio" href="https://www.tiktok.com/music/Sunrise-6618871733141113604?refer=embed">♬ Sunrise - Official Sound Studio</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>
        </div>
        <div class="col-lg-4 col-md-6 col-12 text-center">
            <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/reel/CywZAPtIO-8/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/reel/CywZAPtIO-8/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">Ver esta publicación en Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/reel/CywZAPtIO-8/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">Una publicación compartida por Grupo T&amp;G Ingenieros (@grupotyg_ingenieros)</a></p></div></blockquote>
<script async src="//www.instagram.com/embed.js"></script>
        </div>
        <div class="col-lg-4 col-md-6 col-12 text-center">
            <iframe src="https://www.facebook.com/plugins/video.php?height=476&href=https%3A%2F%2Fwww.facebook.com%2Freel%2F243977998405756%2F&show_text=false&width=267&t=0" width="325" height="900" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
        </div>
    </div> -->
</div>
<!-- fin de seccion de videos -->


@include('general.footer')

@push('scripts')
<script async src="https://www.tiktok.com/embed.js"></script>
<script async src="//www.instagram.com/embed.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="js/addcart.js"></script> -->
<script>
    const baseUrl = "{{ url('/product.detail') }}"; // Esto será "/producto"
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const carousel = document.querySelector('.carousel1');
        const container = document.querySelector('.carousel-container');
        let items = document.querySelectorAll('.carousel-item1');
        const totalItems = items.length;

        // 🔁 Duplicar ítems para lograr efecto infinito fluido
        carousel.innerHTML += carousel.innerHTML;
        items = document.querySelectorAll('.carousel-item1');

        let itemWidth = items[0].clientWidth + 15;
        let scrollPosition = 0;
        let isDragging = false;
        let startX, scrollStart;
        let autoSlideInterval;

        // 🧭 Funciones base
        function updateItemWidth() {
            itemWidth = items[0].clientWidth + 15;
        }

        function startAutoSlide() {
            stopAutoSlide();
            autoSlideInterval = setInterval(() => {
                scrollPosition += itemWidth;
                carousel.style.transition = "transform 0.6s linear";
                carousel.style.transform = `translateX(-${scrollPosition}px)`;

                if (scrollPosition >= itemWidth * totalItems) {
                    setTimeout(() => {
                        carousel.style.transition = "none";
                        scrollPosition = 0;
                        carousel.style.transform = `translateX(0px)`;
                    }, 600);
                }
            }, 3000);
        }

        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }

        // 🎯 Arrastre con mouse
        container.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.pageX;
            scrollStart = scrollPosition;
            stopAutoSlide(); // pausa mientras se arrastra
            carousel.style.transition = "none";
        });

        container.addEventListener('mouseleave', () => {
            if (isDragging) {
                isDragging = false;
                startAutoSlide();
            }
        });

        container.addEventListener('mouseup', () => {
            if (isDragging) {
                isDragging = false;
                startAutoSlide();
            }
        });

        container.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            const deltaX = e.pageX - startX;
            scrollPosition = scrollStart - deltaX;
            carousel.style.transform = `translateX(-${scrollPosition}px)`;

            // Reinicio visual infinito
            if (scrollPosition < 0) {
                scrollPosition = itemWidth * totalItems + scrollPosition;
            } else if (scrollPosition >= itemWidth * totalItems) {
                scrollPosition = scrollPosition - itemWidth * totalItems;
            }
        });

        // 🌐 Arrastre táctil
        container.addEventListener('touchstart', (e) => {
            isDragging = true;
            startX = e.touches[0].clientX;
            scrollStart = scrollPosition;
            stopAutoSlide();
            carousel.style.transition = "none";
        });

        container.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            const deltaX = e.touches[0].clientX - startX;
            scrollPosition = scrollStart - deltaX;
            carousel.style.transform = `translateX(-${scrollPosition}px)`;

            if (scrollPosition < 0) {
                scrollPosition = itemWidth * totalItems + scrollPosition;
            } else if (scrollPosition >= itemWidth * totalItems) {
                scrollPosition = scrollPosition - itemWidth * totalItems;
            }
        });

        container.addEventListener('touchend', () => {
            if (isDragging) {
                isDragging = false;
                startAutoSlide();
            }
        });

        // 🖱️ Pausar autoplay al pasar el mouse (sin arrastrar)
        container.addEventListener('mouseenter', stopAutoSlide);
        container.addEventListener('mouseleave', startAutoSlide);

        // 🧩 Ajustar cuando cambia el tamaño de pantalla
        window.addEventListener('resize', updateItemWidth);

        // 🚀 Iniciar autoplay
        startAutoSlide();
    });
</script>

@endpush

@endsection
