<!-- Topbar Start -->
<div class="container-fluid bg-azul">
    <div class="row align-items-center py-3 px-xl-5 d-none d-lg-flex">        
        <div class="col-lg-4">
            <div class="row">
                <p class="mb-0 mr-3 text-white"><i class="fa fa-phone-alt text-primary mr-2"></i>{{$business->phone}}</p>
                <p class="mb-2 text-white"><i class="fa fa-envelope text-primary mr-2"></i>{{$business->email}}</p>            
            </div>
            <br>
            <a href="/" class="text-decoration-none">
                <img height="50" src="{{asset("storage/$business->image")}}" alt="">
            </a>
        </div>
        <div class="col-lg-5 col-6 text-left">
            <form action="">
                <div class="input-group" style="position: relative;">
                    <input type="text" id="buscar" class="form-control" style="border-radius: 5px 0 0 5px;" placeholder="Encuentra tus productos">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary" style="border-radius: 0 5px 5px 0;">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                    <ul id="resultados" style="position: absolute; z-index:9;" class="list-group mt-5"></ul>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <div class="row">
                
                <div class="ml-auto py-0 d-lg-block">
                    <a class="mr-2 text-white">Siguenos en: </a>
                    <a class="mr-2"href="{{$business->link_youtube}}" target="_blank"><i class="fab fa-youtube text-white"></i></a>
                    <a class="mr-2" href="{{$business->link_facebook}}" target="_blank"><i class="fab fa-facebook-f text-white"></i></a>
                    <a class="mr-2" href="{{$business->link_instagram}}" target="_blank"><i class="fab fa-instagram text-white"></i></a>
                </div>
            </div>
            <br>
            <!-- <h5 class="m-0">{{$business->phone}}</h5> -->
             <div class="navbar-nav ml-auto py-0 d-lg-block">
                <!-- <a href=""> -->
                    <i class="fas fa-user text-white mr-2"></i>
                    @auth
                    <span class="text-white">{{auth::user()->name}}</span>
                    @else
                    <a href="login">Iniciar sesión</a>
                    @endauth
                    
                <!-- </a> -->
                <a href="/cart" class="btn px-0 ml-3">
                    <i class="fas fa-shopping-cart text-white"></i>
                    <span id="cartCount" class="badge text-white border border-secondary rounded-circle" style="padding-bottom: 2px;">
                        {{\Cart::count()}}
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->