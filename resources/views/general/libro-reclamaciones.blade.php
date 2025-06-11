@extends('layouts.app')

@section('content')

@include('general.topbar')
<!-- Navbar Start -->
<div class="container-fluid bg-dark">
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
                </div>
            </nav>
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
                <span class="breadcrumb-item active">Libro de reclamaciones</span>                
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-content px-4">
                <div class="header-text">
                    <h3 class="pt-4">1. DATOS DE LA PERSONA QUE PRESENTA LA QUEJA O RECLAMO</h3>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Fecha Nacimiento</label>
                                <input required type="date" class="form-control" id="fecha_nac" placeholder="Fecha Nacimiento">
                                
                            </div>                      
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Tipo documento</label>
                                <select required class="form-control" name="tipo_doc" id="tipo_doc">
                                    <option value="0">-Seleccionar-</option>
                                    <option value="DNI">DNI</option>
                                    <option value="PASAPORTE">PASAPORTE</option>
                                </select>
                                
                            </div>                       
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Número de documento</label>
                                <input type="number" class="form-control" id="numero_doc" placeholder="Número de documento">
                                
                            </div>                       
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="nombres" placeholder="Nombre">
                                
                            </div>                        
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Apellido paterno</label>
                                <input type="text" class="form-control" id="apellido_pat" placeholder="Apellido paterno">
                                
                            </div>                        
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Apellido materno</label>
                                <input type="text" class="form-control" id="apellido_mat" placeholder="Apellido materno">
                                
                            </div>                        
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email">
                                
                            </div>                       
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                @include('general.phone')
                            </div>                       
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Departamento</label>
                                <select id="departamento" class="form-control departamento" name="mauticform[departamento]">    
                                    <option data-id="" value="">-Seleccionar-</option>
                                </select>
                                
                            </div>                       
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Provincia</label>
                                <select id="provincia" class="form-control provincia" name="mauticform[provincia1]">
                                    <option data-id="" value="Chachapoyas">-Seleccionar-</option>                
                                </select>
                                
                            </div>                         
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Distrito</label>
                                <select id="distrito" class="form-control distrito" name="mauticform[distrito1]">
                                    <option data-id="" value="">-Seleccionar-</option>
                                </select>
                                
                            </div>                        
                        </div>

                        <div class="col-lg-9 col-md-12 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Dirección fiscal</label>
                                <input type="text" class="form-control" id="direccion" placeholder="Direccion">
                                
                            </div>                       
                        </div>
                    </div>
                    <h3 class="pt-4">2. INFORMACIÓN GENERAL</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Orden de compra</label>
                                <input type="text" class="form-control" id="orden_compra" placeholder="Orden de compra">
                                
                            </div>                      
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Monto del producto/servicio</label>
                                <input type="number" class="form-control" id="producto" placeholder="Monto del producto/servicio">
                                
                            </div>                       
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Detalla tu queja/reclamo</label>
                                <textarea class="form-control" id="reclamo" rows="5" placeholder="Escribe"></textarea>
                                
                            </div>                        
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-4 px-6">
                            <div class="form-floating">
                                <label for="name">Pedido</label>
                                <textarea class="form-control" id="pedido" rows="5" placeholder="Escribe"></textarea>
                                
                            </div>                         
                        </div>
                        <div class="col-lg-12 my-4 text-center">
                            <button class="btn btn-primary py-3 enviar">Enviar reclamo</button>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>


@include('general.footer')


@endsection