@extends('layouts.app')

@section('content')

@include('general.topbar')

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
                    <a href="/" class="text-decoration-none d-block d-lg-none">
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

<div class="d-flex justify-content-center align-items-center pt-5 bg-light">
    <div class="card shadow-lg border-0 rounded-4 text-center p-4" style="max-width: 450px;">
        <!-- Icono animado -->
        <div class="d-flex justify-content-center mb-3">
            <div class="success-checkmark">
                <div class="check-icon">
                    <span class="icon-line line-tip"></span>
                    <span class="icon-line line-long"></span>
                    <div class="icon-circle"></div>
                    <div class="icon-fix"></div>
                </div>
            </div>
        </div>

        <h2 class="fw-bold text-success">¡Pago Exitoso!</h2>
        <p class="text-muted mt-2">
            Gracias por tu compra. Hemos recibido tu pedido correctamente y pronto te enviaremos la confirmación por correo.
        </p>

        <div class="mt-4">
            <a href="{{ route('store') }}" class="btn btn-primary w-100 rounded-pill">
                Seguir Comprando
            </a>
            <!-- <a href=" route('orders.index') " class="btn btn-outline-secondary w-100 mt-2 rounded-pill">
                Ver Mis Pedidos
            </a> -->
        </div>
    </div>
</div>

{{-- Estilos personalizados para el check animado --}}
<style>
.success-checkmark {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: inline-block;
    position: relative;
    box-shadow: 0 0 0 4px #28a74533;
}
.check-icon {
    position: relative;
    width: 80px;
    height: 80px;
}
.icon-circle {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 4px solid #28a745;
    top: 0;
    left: 0;
    box-sizing: border-box;
    animation: scaleIn 0.4s ease-in-out;
}
.icon-line {
    height: 5px;
    background-color: #28a745;
    display: block;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
}
.line-tip {
    top: 40px;
    left: 14px;
    width: 25px;
    transform: rotate(45deg);
    animation: drawTip 0.3s ease forwards 0.5s;
}
.line-long {
    top: 32px;
    right: 10px;
    width: 45px;
    transform: rotate(-45deg);
    animation: drawLong 0.3s ease forwards 0.8s;
}
@keyframes scaleIn {
    0% { transform: scale(0); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
@keyframes drawTip {
    0% { width: 0; }
    100% { width: 25px; }
}
@keyframes drawLong {
    0% { width: 0; }
    100% { width: 45px; }
}
</style>


@include('general.footer')

@endsection
