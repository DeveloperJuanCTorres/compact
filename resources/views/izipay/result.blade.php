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

                        <a href="" class="btn btn-primary">
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
