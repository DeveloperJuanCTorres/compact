<!-- Footer Start -->
<div class="container-fluid bg-mobil text-secondary mt-5 pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="/">
                <img class="pb-4" width="200" src="{{asset("storage/$business->image")}}" alt="">
            </a>            
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$business->address}}</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{$business->email}}</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{$business->phone}}</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5 p-0">
                    <h5 class="text-secondary text-uppercase mb-4">Enlaces</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="/"><i class="fa fa-angle-right mr-2"></i>Inicio</a>
                        <a class="text-secondary mb-2" href="/store"><i class="fa fa-angle-right mr-2"></i>Tienda</a>
                        <a class="text-secondary mb-2" href="/about"><i class="fa fa-angle-right mr-2"></i>Nosotros</a>
                        <a class="text-secondary mb-2" href="/contact"><i class="fa fa-angle-right mr-2"></i>Contáctanos</a>
                        <a class="text-secondary mb-2" href="/politicas"><i class="fa fa-angle-right mr-2"></i>Políticas de privacidad</a>
                        <a class="text-secondary" href="/terminos"><i class="fa fa-angle-right mr-2"></i>Términos y condiciones</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5 p-0">
                    <h5 class="text-secondary text-uppercase mb-4">Hoja informativa</h5>
                    <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                    
                    <h6 class="text-secondary text-uppercase mt-4 mb-3">Síguenos</h6>
                    <div class="d-flex">                        
                        <a class="btn btn-primary btn-square mr-2" href="{{$business->link_facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="{{$business->link_tiktok}}" target="_blank">                              
                            <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#fff" d="M544.5 273.9C500.5 274 457.5 260.3 421.7 234.7L421.7 413.4C421.7 446.5 411.6 478.8 392.7 506C373.8 533.2 347.1 554 316.1 565.6C285.1 577.2 251.3 579.1 219.2 570.9C187.1 562.7 158.3 545 136.5 520.1C114.7 495.2 101.2 464.1 97.5 431.2C93.8 398.3 100.4 365.1 116.1 336C131.8 306.9 156.1 283.3 185.7 268.3C215.3 253.3 248.6 247.8 281.4 252.3L281.4 342.2C266.4 337.5 250.3 337.6 235.4 342.6C220.5 347.6 207.5 357.2 198.4 369.9C189.3 382.6 184.4 398 184.5 413.8C184.6 429.6 189.7 444.8 199 457.5C208.3 470.2 221.4 479.6 236.4 484.4C251.4 489.2 267.5 489.2 282.4 484.3C297.3 479.4 310.4 469.9 319.6 457.2C328.8 444.5 333.8 429.1 333.8 413.4L333.8 64L421.8 64C421.7 71.4 422.4 78.9 423.7 86.2C426.8 102.5 433.1 118.1 442.4 131.9C451.7 145.7 463.7 157.5 477.6 166.5C497.5 179.6 520.8 186.6 544.6 186.6L544.6 274z"/></svg>
                        </a>
                        <a class="btn btn-primary btn-square mr-2" href="{{$business->link_instagram}}" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-primary btn-square" href="{{$business->link_youtube}}" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-5 p-0">
                    <h5 class="text-secondary text-uppercase mb-4 text-center">Libro de reclamaciones</h5>
                    <a href="/libro-reclamaciones">
                        <img class="d-block m-auto" width="90" src="{{asset('img/libro.png')}}" alt="">
                    </a>
                    <p class="text-center">RUC: {{$business->ruc}}</p>
                    <p class="text-center">{{$business->name}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-secondary">
                &copy; <a class="text-primary" href="#">{{$business->name}}</a>. Todos los derechos reservados. 
                <br>Hecho por: <a href="https://grupotyg.pe" target="_blank">Grupo TyG Ingenieros</a>
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="img/payments.png" alt="">
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>