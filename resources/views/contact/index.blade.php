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
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
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

                            <!-- Lado derecho: Carrito -->
                            <a href="/cart" class="btn px-0 d-flex align-items-center">
                                <i class="fas fa-shopping-cart text-white"></i>
                                <span id="cartCount" class="badge text-white border border-secondary rounded-circle ml-1" style="padding-bottom: 2px;">
                                    {{ \Cart::count() }}
                                </span>
                            </a>
                        </div>

                        <div class="navbar-nav mr-auto py-0">
                            <a href="/" class="nav-item nav-link">Inicio</a>
                            <a href="/store" class="nav-item nav-link">Tienda</a>
                            <a href="/about" class="nav-item nav-link">Nosotros</a>
                            <a href="/contact" class="nav-item nav-link active">Contáctanos</a>
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
                <span class="breadcrumb-item active">Contáctanos</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Contact Start -->
<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase px-xl-5 mb-4"><span class="pr-3">Contáctanos</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form bg-light">
                <!-- <div id="success"></div> -->
                <form id="contactForm" method="POST" action="{{ route('contact.send') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row p-0">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="control-group">
                                <input type="text" class="form-control inputTexto" name="name" id="name" placeholder="Nombre"
                                    required="required" data-validation-required-message="Por favor ingrese su nombre" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control inputTexto" name="email" id="email" placeholder="Email"
                                    required="required" data-validation-required-message="Por favor ingrese su correo" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control inputTexto" name="subject" id="subject" placeholder="Asunto"
                                    required="required" data-validation-required-message="Ingrese el asunto" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    
                        <div class="col-lg-6 col-md-6 col-12">
                            <label for="file" class="custom-file-upload">
                                <i class="bi bi-cloud-arrow-up" style="font-size: 2rem;"></i>
                                <br>
                                Haz clic o arrastra un archivo aquí
                            </label>
                            <input name="file" id="file" type="file" />
                            <div id="file-preview" class="file-preview"></div>
                        </div>

                        <div class=" col-lg-12 col-md-12 col-12control-group">
                            <textarea class="form-control inputTexto" rows="4" name="mensaje" id="mensaje" placeholder="Mensaje..."
                                required="required"
                                data-validation-required-message="Ingrese un mensaje"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="m-auto">
                            <button class="btn btn-primary py-2 px-4" type="submit">Enviar mensaje</button>
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <div class="bg-light mb-30">
                <iframe style="width: 100%; height: 250px;"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.62973772995696!2d-79.84141211142473!3d-6.760611326662773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x904cef9963844393%3A0xc89078e378873b22!2sCOMPACT%20SEGURIDAD%20Y%20CONSTRUCCI%C3%93N!5e0!3m2!1ses!2spe!4v1756663388479!5m2!1ses!2spe"
                frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="bg-light mb-3">
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$business->address}}</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{$business->email}}</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>{{$business->phone}}</p>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

@include('general.footer')

<!-- Bootstrap Icons (si quieres usar el icono de upload) -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    document.querySelectorAll('.inputTexto').forEach(function (input) {
        input.addEventListener('input', function (e) {
            const prohibido = /[<>{};*$%=()&]/g; // Caracteres que quieres bloquear
            if (prohibido.test(e.target.value)) {
                e.target.value = e.target.value.replace(prohibido, '');
            }
        });
    });
</script>  

<script>
  const fileInput = document.getElementById('file');
  const filePreview = document.getElementById('file-preview');

  fileInput.addEventListener('change', function () {
    if (this.files && this.files.length > 0) {
      filePreview.textContent = "📂 " + this.files[0].name;
    } else {
      filePreview.textContent = "";
    }
  });
</script>

<script>
    document.getElementById("contactForm").addEventListener("submit", function(e) {
        e.preventDefault();

        let form = this;
        let formData = new FormData(form);

        // Mostrar loading
        Swal.fire({
            title: 'Enviando...',
            text: 'Por favor espere',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });

        fetch(form.action, {
            method: form.method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            Swal.close(); // cerrar loading

            if (data.status) {
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
                icon: "success",
                title: data.msg
                });  

                form.reset(); // limpiar formulario
                document.getElementById("file-preview").textContent = "";
            } else {
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
                icon: "error",
                title: data.msg
                });  

                form.reset(); // limpiar formulario
                document.getElementById("file-preview").textContent = "";
            }
        })
        .catch(error => {
            Swal.close();

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
                icon: "error",
                title: 'Hubo un problema al enviar. Inténtalo más tarde.'
                });  
            
                form.reset(); // limpiar formulario
                document.getElementById("file-preview").textContent = "";
            console.error(error);
        });
    });
</script>
@endsection