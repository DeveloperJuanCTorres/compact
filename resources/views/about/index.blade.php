@extends('layouts.app')

@section('content')

@include('general.topbar')
<!-- Navbar Start -->
    <div class="container-fluid bg-mobil">
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
                            <a href="/about" class="nav-item nav-link active">Nosotros</a>
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
                <span class="breadcrumb-item active">Sobre nosotros</span>                
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- About Start -->
<div class="container-fluid overflow-hidden py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.1s">
                <div class="bg-light rounded">
                    <img src="storage/{{$nosotros->image}}" class="img-fluid w-100" style="margin-bottom: -7px;" alt="Image">
                    <!-- <img src="img/about-3.jpg" class="img-fluid w-100 border-bottom border-5 border-primary" style="border-top-right-radius: 300px; border-top-left-radius: 300px;" alt="Image"> -->
                </div>
            </div>
            <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.3s">
                <h5 class="sub-title pe-3">{{$nosotros->subtitulo}}</h5>
                <h1 class="display-5 mb-4">{{$nosotros->titulo}}</h1>
                <p class="mb-4">{!! Str::markdown($nosotros->description) !!}</p>
                <div class="row gy-4 align-items-center">
                    <div class="col-4 col-md-3">
                        <div class="bg-light text-center rounded p-3">
                            <div class="mb-2">
                                <i class="fas fa-award fa-4x text-primary"></i>
                            </div>
                            <h1 class="display-5 fw-bold mb-2">{{$nosotros->experiencia}}</h1>
                            <p class="text-muted mb-0">Años de Experiencia</p>
                        </div>
                    </div>
                    <div class="col-8 col-md-9">
                        <div class="d-flex flex-wrap">
                            <div id="phone-tada" class="d-flex align-items-center justify-content-center me-4">
                                <a href="" class="position-relative wow tada" data-wow-delay=".9s">
                                    <i class="fa fa-phone-alt text-primary fa-3x"></i>
                                    <div class="position-absolute" style="top: 0; left: 25px;">
                                        <span><i class="fa fa-comment-dots text-secondary"></i></span>
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <span class="text-primary">¿Tienes alguna pregunta?</span>
                                <span class="fw-bold fs-5" style="letter-spacing: 2px;color: #003A66;">{{$nosotros->telefono}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<div class="container-fluid features overflow-hidden py-5">
    <div class="container py-5">
        <div class="row g-4 justify-content-center text-center">
            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="feature-item text-center p-4 bg-light" style="border: solid #D0CFD0; border-radius: 10px;">
                    <div class="feature-icon p-3 mb-4">
                        <i class="fas fa-users fa-4x text-primary"></i>
                    </div>
                    <div class="feature-content d-flex flex-column">
                        <h5 class="mb-3">Misión</h5>
                        <p class="mb-3">{!! Str::markdown($nosotros->mision) !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="feature-item text-center p-4 bg-light" style="border: solid #D0CFD0; border-radius: 10px;">
                    <div class="feature-icon p-3 mb-4">
                        <i class="fas fa-low-vision fa-4x text-primary"></i>
                    </div>
                    <div class="feature-content d-flex flex-column">
                        <h5 class="mb-3">Visión</h5>
                        <p class="mb-3">{!! Str::markdown($nosotros->vision) !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="feature-item text-center p-4 bg-light" style="border: solid #D0CFD0; border-radius: 10px;">
                    <div class="feature-icon p-3 mb-4">
                        <i class="fas fa-user-graduate fa-4x text-primary"></i>
                    </div>
                    <div class="feature-content d-flex flex-column">
                        <h5 class="mb-3">Valores</h5>
                        <p class="mb-3">{!! Str::markdown($nosotros->valores) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@include('general.footer')


@endsection