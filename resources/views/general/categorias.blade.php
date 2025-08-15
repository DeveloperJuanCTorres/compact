<link href="{{asset('css/carrusel.css')}}" rel="stylesheet">

<div class="carouselcat-container container-fluid pt-4">
    <div class="text-center">
        <h3>¿Qué tipo de implemento de Seguridad estás buscando?</h3>
        <span>Encuentra el quipo de protección que necesitas para tu seguridad laboral</span>
    </div>
    <div class="carouselcat pt-4">
        <div class="d-flex m-auto">
            @foreach($categories as $key => $category)
            <!-- <div class="col-lg-3 col-md-4 col-sm-12"> -->
                <div class="product-card">
                    <img src="storage/{{$category->image}}" class="product-image" alt="{{$category->name}}">
                    <h3 class="product-name">{{$category->name}}</h3>
                    <span>{{$category->description}}</span><br>
                    
                    <a class="btn btn-primary mt-2" href="{{ route('store', ['categories' => $category->id]) }}" title="productos">Ver productos</a>
                </div>
            <!-- </div> -->
            @endforeach
        </div>
    </div>
    <button class="carouselcat-button prev" onclick="slide(-1)">←</button>
    <button class="carouselcat-button next" onclick="slide(1)">→</button>
</div>

<script>
    let position = 0;
    const carousel = document.querySelector('.carouselcat');
    const cards = document.querySelectorAll('.product-card');
    const cardWidth = 320; // ancho del card + margen
    const maxPosition = (cards.length - 1) * cardWidth;

    function slide(direction) {
        position += direction * cardWidth;
        // Limitar el deslizamiento
        if (position < 0) position = 0;
        if (position > maxPosition) position = maxPosition;

        carousel.style.transform = `translateX(-${position}px)`;
    }
</script>