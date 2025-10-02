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
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        @if(Cart::count() > 0)
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach(Cart::content() as $item)
                    <tr>
                        <td class="d-flex align-items-center" style="text-align: left;">
                            <img src="{{ asset($item->options->image) }}" alt="" style="width: 50px;"> 
                            <div class="d-block my-auto px-2">
                                <p class="mb-0">{{ $item->name }}</p>

                                {{-- ✅ Mostrar color y talla si existen --}}
                                @if($item->options->color_name || $item->options->size_name)
                                    <small class="text-muted">
                                        @if($item->options->color_name)
                                            Color: {{ $item->options->color_name }}
                                        @endif
                                        @if($item->options->size_name)
                                            @if($item->options->color_name) | @endif
                                            Talla: {{ $item->options->size_name }}
                                        @endif
                                    </small>
                                @else
                                    <small class="text-muted">Sin variantes</small>
                                @endif
                            </div>
                        </td>

                        <td class="align-middle">S/. {{ number_format($item->price, 2) }}</td>

                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-primary btn-minus" data-rowid="{{ $item->rowId }}">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" 
                                    class="form-control form-control-sm bg-secondary border-0 text-center qty-input" 
                                    value="{{ $item->qty }}" 
                                    data-rowid="{{ $item->rowId }}">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-primary btn-plus" data-rowid="{{ $item->rowId }}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>

                        <td class="align-middle subtotal-item" data-rowid="{{ $item->rowId }}">
                            S/. {{ number_format($item->price * $item->qty, 2) }}
                        </td>

                        <td class="align-middle">
                            <form action="{{ route('removeitem') }}" method="post">
                                @csrf
                                <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container row py-4">
                <a href="{{route('clear')}}" class="btn bg-dark py-2 px-4 text-white" style="border-radius: 10px;">Limpiar carrito</a>
            </div>
        </div>
        <div class="col-lg-4">
            <form class="mb-30" action="">
                <div class="input-group">
                    <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Aplicar cupón</button>
                    </div>
                </div>
            </form>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Resumen del carrito</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="subtotal-general">S/. {{number_format(Cart::subtotal() - Cart::subtotal()*0.18,2)}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">IGV</h6>
                        <h6 class="font-weight-medium" id="igv">S/. {{number_format(Cart::subtotal()*0.18,2)}}</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="cart-total">S/. {{number_format(Cart::subtotal(),2)}}</h5>
                    </div>
                    <a href="/checkout" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Ir a pagar</a>
                </div>
            </div>
        </div>
        @else
        <div class="container">
            <div class="row px-xl-5">
                <h5>No existen productos en tu carrito</h5>
                <div class="d-block m-auto">
                    <a href="/" class="btn btn-primary py-2 px-4" style="border-radius: 10px;">Ir al inicio</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Cart End -->

@include('general.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.btn-plus, .btn-minus', function(e) {
        e.preventDefault();
        let input = $(this).closest('.quantity').find('.qty-input');
        let rowId = input.data('rowid');
        let qty   = parseInt(input.val());

        if ($(this).hasClass('btn-plus')) {
            qty++;
        } else {
            if (qty > 1) qty--;
        }

        input.val(qty);

        // AJAX para actualizar carrito
        $.ajax({
            url: "{{ route('cart.update') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                rowId: rowId,
                qty: qty
            },
            success: function(response) {
                if (response.success) {
                    // actualizar subtotal del item
                    $(`.subtotal-item[data-rowid='${rowId}']`).text('S/. ' + response.subtotalItem);

                    // actualizar resumen
                    $("#subtotal-general").text('S/. ' + response.subtotalGeneral);
                    $("#igv").text('S/. ' + response.igv);
                    $("#cart-total").text('S/. ' + response.total);
                }
            }
        });
    });
</script>

@endsection