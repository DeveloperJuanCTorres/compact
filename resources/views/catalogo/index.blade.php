<!DOCTYPE html>
<html>
<head>
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { font-family: Arial; }
        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .card {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
        }
        img {
            width: 100%;
            height: 150px;
            object-fit: contain;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">CATÁLOGO DE PRODUCTOS</h2>

<div class="grid">
    @foreach($products as $product)
        <div class="card">
            @if($product->first_image)
                <img src="{{ asset('storage/'.$product->first_image) }}">
            @endif

            <h4>{{ $product->name }}</h4>
            <p>S/ {{ number_format($product->price, 2) }}</p>
            <small>{{ Str::limit($product->description, 80) }}</small>
        </div>
    @endforeach
</div>

</body>
</html>