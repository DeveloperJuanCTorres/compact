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
                        <a class="btn btn-primary btn-square mr-2" href="{{$business->link_youtube}}" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="{{$business->link_facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="{{$business->link_linkedin}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-primary btn-square" href="{{$business->link_instagram}}" target="_blank"><i class="fab fa-instagram"></i></a>
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