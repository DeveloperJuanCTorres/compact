@foreach($brands as $key => $brand)
<div class="additional-product-item d-flex align-items-center justify-content-between py-2">

    <div class="d-flex align-items-center flex-grow-1 me-2">
        <input type="radio"
               class="me-2"
               id="brandm-{{ $brand->id }}"
               name="brands[]"
               value="{{ $brand->id }}"
               {{ $selectedBrand  == $brand->id ? 'checked' : '' }}>

        <label for="brandm-{{ $brand->id }}"
               class="text-dark mb-0 px-2"
               style="font-size: 13px; word-break: break-word;">
            {{ $brand->name }}
        </label>
    </div>

    <span class="badge border font-weight-normal bg-primary text-white">
        {{ $brand->productsInStock->count() }}
    </span>
</div>
@endforeach
