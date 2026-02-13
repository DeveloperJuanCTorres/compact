@foreach($brands as $brand)
    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">

        <input type="radio"
               class="custom-control-input"
               id="brand-{{ $brand->id }}"
               name="brands[]"
               value="{{ $brand->id }}"
               {{ $selectedBrand  == $brand->id ? 'checked' : '' }}>

        <label class="custom-control-label" for="brand-{{ $brand->id }}">
            {{ $brand->name }}
        </label>

        <span class="badge border font-weight-normal bg-primary text-white">
            {{ $brand->productsInStock->count() }}
        </span>
    </div>
@endforeach