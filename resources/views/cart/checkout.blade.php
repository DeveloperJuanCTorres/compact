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

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="/">Inicio</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Checkout Start -->
<div class="container-fluid">
    <form action="{{route('izipay')}}" method="POST">
        @csrf
        <div class="row px-xl-5">
            
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Billing Address</span></h5>            
                <div class="bg-light mb-5">
                    <div class="row">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" id="tipo_cliente" name="tipo_cliente" value="natural" checked onclick="mostrarCampos()">Natural
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" id="tipo_cliente" name="tipo_cliente" value="empresa" onclick="mostrarCampos()">Empresa
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="campo_cliente">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" type="text" id="nombre" name="nombre" placeholder="John">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Apellidos</label>
                                    <input class="form-control" type="text" id="apellidos" name="apellidos" placeholder="Doe">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="display: none;" id="campo_empresa">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>RUC</label>
                                    <input class="form-control" type="text" id="ruc" name="ruc">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Razon social</label>
                                    <input class="form-control" type="text" id="company" name="company">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" id="email" name="email" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            @include('general.phone')
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Dirección</label>
                            <input class="form-control" type="text" id="direccion" name="direccion" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Departamento</label>
                            <select id="departamento" class="form-control departamento" name="mauticform[departamento]">    
                                <option data-id="" value="">-Seleccionar-</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Provincia</label>
                            <select id="provincia" class="form-control provincia" name="mauticform[provincia1]">
                                <option data-id="" value="Chachapoyas">-Seleccionar-</option>                
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Distrito</label>
                            <select id="distrito" class="form-control distrito" name="mauticform[distrito1]">
                                <option data-id="" value="">-Seleccionar-</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Total del pedido</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Productos</h6>
                        @foreach(Cart::content() as $item)
                        <div class="d-flex justify-content-between">
                            <p>[ x{{$item->qty}} ] - {{$item->name}}</p>
                            <p style="width: 220px;text-align: end;">S/. {{number_format($item->price * $item->qty, 2)}}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>S/. {{number_format(Cart::subtotal() - Cart::subtotal()*0.18,2)}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">IGV</h6>
                            <h6 class="font-weight-medium">S/. {{number_format(Cart::subtotal()*0.18,2)}}</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>S/. {{number_format(Cart::subtotal(),2)}}</h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">Realizar pedido</button>
                </div>
            </div>
            
        </div>
    </form>
</div>
<!-- Checkout End -->

@include('general.footer')

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function mostrarCampos() {
        const tipo = document.querySelector('input[name="tipo_cliente"]:checked').value;
        document.getElementById('campo_cliente').style.display = tipo === 'natural' ? 'block' : 'none';
        document.getElementById('campo_empresa').style.display = tipo === 'empresa' ? 'block' : 'none';
    }

    // Por si acaso se recarga la página con un valor diferente ya seleccionado
    document.addEventListener('DOMContentLoaded', mostrarCampos);
</script>
<script>
    let token = $('meta[name="csrf-token"]').attr('content');

    $(function() {
        $(".pedido").on('click',function () {
            var nombre = $("#nombre").val();
            var apellidos = $("#apellidos").val();
            var ruc = $("#ruc").val();
            var empresa = $("#company").val();
            var codigo = $("#codigo").val();
            var telefono = $("#telefono").val();
            var email = $("#email").val();
            var direccion = $("#direccion").val();
            var hoy = new Date();   
                                
            if (document.querySelector('input[name="tipo_cliente"]:checked').value == 'natural') {
                if (nombre == '') {
                    const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "warning",
                    title: "El nombre es requerido"
                    });
                    $('#nombre').focus();
                    return false;
                }
                if (apellidos == '') {
                    const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "warning",
                    title: "El apellido es requerido"
                    });
                    $('#apellidos').focus();
                    return false;
                }
            }

            if (document.querySelector('input[name="tipo_cliente"]:checked').value == 'empresa') {
                if (ruc == '') {
                    const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "warning",
                    title: "El RUC es requerido"
                    });
                    $('#ruc').focus();
                    return false;
                }
                if (empresa == '') {
                    const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "warning",
                    title: "La razon Social es requerido"
                    });
                    $('#company').focus();
                    return false;
                }
            }
            
            if (telefono == '') {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
                });
                Toast.fire({
                icon: "warning",
                title: "El teléfono es requerido"
                });
                $('#telefono').focus();
                return false;
            }
            if (direccion == '') {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
                });
                Toast.fire({
                icon: "warning",
                title: "La dirección es requerido"
                });
                $('#direccion').focus();
                return false;
            }

            Swal.fire({
                header: '...',
                title: 'loading...',
                allowOutsideClick:false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: "/izipay",
                method: "post",
                dataType: 'json',
                data: {
                    _token: token,
                    nombre: nombre,
                    apellidos : apellidos,
                    empresa : empresa,
                    codigo : codigo,
                    telefono: telefono,
                    email: email,
                    direccion: direccion
                },
                success: function (response) {   
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pedido',
                            text: response.msg,   
                            confirmButtonColor: "#e75e8d",                           
                        })
                        .then(resultado => {
                            window.location.href = "/";
                        })                 
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Ups, algo salio mal',
                            text: response.msg,
                            confirmButtonColor: "#e75e8d",
                        })
                    }
                },
                error: function (response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...!!',
                        text: response.msg,
                    })
                }
            });
        });
    })
</script>
@endpush

@endsection