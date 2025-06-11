<div class="col-12 pb-1">
    <div class="d-flex align-items-center justify-content-between mb-4">
     
    </div>
</div>
@foreach($products as $product)
<div class="col-lg-4 col-md-6 col-sm-12 pb-1">
    <div class="product-item bg-light mb-4" style="border: 1px solid #ddd;border-radius: 10px;">
        <div class="product-img position-relative overflow-hidden">
            @php
                $imagenes = json_decode($product->images)
            @endphp
            @if($imagenes)
            <img class="img-fluid w-100" src="storage/{{$imagenes[0]}}" alt="">
            @else
            <img class="img-fluid w-100" src="img/defectomaster.jpeg" alt="">
            @endif
            <div class="product-action">
                <input type="hidden" id="qty" value="1">
                <a class="btn btn-outline-dark" href="{{route('product.detail', $product)}}">
                    Detalle del producto
                    <i class="fa fa-search"></i>                            
                </a>
            </div>
        </div>
        <div class="px-4 py-4">
            <div class="d-flex  mb-1">
                <small class="text-muted" style="font-size: 12px;">{{$product->taxonomy->name}}</small>
            </div>
            <a class="h6 text-decoration-none text-truncate" href="{{route('product.detail', $product)}}">{{$product->name}}</a>
            <div class="d-flex mt-2">
                <h5>S/. {{$product->price}}</h5><h6 class="text-muted ml-2"><del>S/. {{$product->price*1.20}}</del></h6>
            </div>  
            <a class="btn btn-primary addcart w-100" href="javascript:void(0)" data-id="{{$product->id}}">
                <i class="fa fa-shopping-cart"></i>
                Agregar al carrito
            </a>               
        </div>
    </div>
</div>
@endforeach  
<div class="col-12">
    {{ $products->links('vendor.pagination.bootstrap-5') }}
</div>
