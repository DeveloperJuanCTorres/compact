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
            <!-- Category Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Filtrar por categoría</span></h5>
            <form id="filterForm">
                <div class="bg-light p-4 mb-30">
                    @foreach($categories as $category)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" class="custom-control-input" name="categories[]" value="{{ $category->id }}"
                        {{ request('categories') == $category->id ? 'checked' : '' }}>
                        <label class="custom-control-label">{{$category->name}}</label>
                        <span class="badge border font-weight-normal">{{$category->productsInStock->count()}}</span>
                    </div>
                    @endforeach
                </div>
                <!-- Category End -->
            
                <!-- Brand Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Filtrar por marca</span></h5>
                <div class="bg-light p-4 mb-30">
                        @foreach($brands as $brand)
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" class="custom-control-input" name="brands[]" value="{{ $brand->id }}">
                            <label class="custom-control-label">{{$brand->name}}</label>
                            <span class="badge border font-weight-normal">{{$brand->productsInStock->count()}}</span>
                        </div>
                        @endforeach
                </div>
                <!-- Brand End -->
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
<script src="js/addcart.js"></script>
<script>
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

    // Paginación AJAX
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
@endpush

@endsection