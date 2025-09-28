@extends('layouts.app')

@section('content')

@include('general.topbar')

<!-- Libreria JS de la pasarela, debe incluir la clave pública -->
  <script type="text/javascript"
    src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
    kr-public-key="{{$publicKey}}"
    kr-post-url-success="result" kr-language="es-Es">
  </script>

  <!-- Estilos de la pasarela de pagos -->
  <link rel="stylesheet" href="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic.css">
  <script type="text/javascript" src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic.js">
  </script>

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

                <div style="position: absolute; right: 0;">
                    <div id="promo-btn">
                        <a class="btn-promo btn-secondary" href="/ofertas">Ofertas</a>
                        <img src="img/promo.png" class="promo-tag swing">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Navbar End -->

<section class="container-fluid pt-5">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="center-column col-md-6">
      <section class="payment-form">
        <div class="row">
          <li>Pago con tarjeta de crédito/débito</li>
          <img src="https://github.com/izipay-pe/Imagenes/blob/main/logo_tarjetas_aceptadas/logo-tarjetas-aceptadas-351x42.png?raw=true" alt="Tarjetas aceptadas" style="width: 200px;">
        </div>
        <hr>
        <div id="micuentawebstd_rest_wrapper">
          <!-- HTML para incrustar pasarela de pagos -->
          <div class="kr-embedded" kr-popin kr-form-token="{{$formToken}}">
            @csrf
          </div>
          <!---->
        </div>
      </section>
    </div>
    <div class="col-md-3"></div>
  </div>
</section>

@include('general.footer')

@endsection
