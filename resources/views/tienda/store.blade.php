<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
                            <a href="/" class="nav-item nav-link active">Inicio</a>
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
                <span class="breadcrumb-item active">Tienda</span>                
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            
            <form id="filterForm">

                <div class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" id="searchInput" class="form-control" placeholder="Buscar producto..." value="{{ request('search') }}">
                        <button type="button" id="clearSearch" class="btn btn-danger">×</button>
                    </div>
                </div>

                <div class="mb-4 text-end">
                    <button type="button" id="resetFilters" class="btn btn-sm btn-danger">Limpiar filtros</button>
                </div>
                
                <div class="accordion" id="accordionExample">
                       
                    <div class="accordion-item">                                
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Filtrar por Categoría
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="bg-light mb-30">
                                    @foreach($categories as $category)
                                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                        <input type="radio" class="custom-control-input" name="categories[]" value="{{ $category->id }}"
                                        {{ request('categories') == $category->id ? 'checked' : '' }}>
                                        <label class="custom-control-label">{{$category->name}}</label>
                                        <span class="badge border font-weight-normal bg-primary text-white">{{$category->productsInStock->count()}}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>                            
                    </div>  
                    
                    <div class="accordion-item">                                
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Filtrar por Marca
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="bg-light mb-30">
                                    @foreach($brands as $brand)
                                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                        <input type="radio" class="custom-control-input" name="brands[]" value="{{ $brand->id }}">
                                        <label class="custom-control-label">{{$brand->name}}</label>
                                        <span class="badge border font-weight-normal bg-primary text-white">{{$brand->productsInStock->count()}}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>                            
                    </div> 
                </div>                
            </form>
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <!-- Spinner oculto al principio -->
            <div id="loadingSpinner" class="hidden absolute inset-0 flex items-center justify-center bg-white bg-opacity-75 z-10">
                <div class="w-12 h-12 border-4 border-blue-500 border-dashed rounded-full animate-spin"></div>
            </div>
            <div class="row pb-3" id="productContainer">
                @include('tienda.product-list')
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->


@include('general.footer')

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="js/addcart.js"></script> -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('filterForm');
        const productContainer = document.getElementById('productContainer');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const searchInput = document.getElementById('searchInput');
        const clearSearch = document.getElementById('clearSearch');
        const resetFilters = document.getElementById('resetFilters');

        let debounceTimeout;

        // 🟦 Buscar mientras escribe (con debounce)
        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                fetchProducts();
            }, 300);
        });

        // 🟨 Limpiar búsqueda (botón "X")
        clearSearch.addEventListener('click', function () {
            searchInput.value = '';
            fetchProducts(); // recarga todos los productos
        });

        // 🟥 Limpiar todos los filtros
        resetFilters.addEventListener('click', function () {
            form.reset(); // limpia todos los inputs del formulario
            fetchProducts(); // recarga todos los productos
        });

        // 🟩 Detectar cambio de categoría o marca
        form.addEventListener('change', function () {
            fetchProducts();
        });

        // 🌀 Cargar productos mediante AJAX
        function fetchProducts(page = 1) {
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);

            loadingSpinner.classList.remove('hidden'); // Mostrar spinner

            fetch(`{{ route('store') }}?${params.toString()}&page=${page}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.text())
            .then(html => {
                productContainer.innerHTML = html;
            })
            .finally(() => {
                loadingSpinner.classList.add('hidden'); // Ocultar spinner
            });
        }

        // 🔄 Paginación AJAX
        document.addEventListener('click', function(e) {
            if (e.target.closest('.pagination a')) {
                e.preventDefault();
                const url = new URL(e.target.href);
                const page = url.searchParams.get('page');
                fetchProducts(page);
            }
        });
    });
</script>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('filterForm');
    const productContainer = document.getElementById('productContainer');
    const loadingSpinner = document.getElementById('loadingSpinner');

    form.addEventListener('change', function () {
        fetchProducts();
    });

    function fetchProducts(page = 1) {
        const formData = new FormData(form);
        const params = new URLSearchParams(formData);

        loadingSpinner.classList.remove('hidden'); // Mostrar spinner

        fetch(`{{ route('store') }}?${params.toString()}&page=${page}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            productContainer.innerHTML = html;
        })
        .finally(() => {
            loadingSpinner.classList.add('hidden'); // Ocultar spinner
        });
    }

    document.addEventListener('click', function(e) {
        if (e.target.closest('.pagination a')) {
            e.preventDefault();
            const url = new URL(e.target.href);
            const page = url.searchParams.get('page');
            fetchProducts(page);
        }
    });
});
</script> -->
@endpush

@endsection