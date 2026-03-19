<!DOCTYPE html>
<html>
<head>
    <title>Catálogo de Productos</title>
    <meta charset="utf-8">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background: #f5f5f5;
        }

        /* 🔥 BANNER */
        .banner {
            width: 100%;
            height: 300px;
            background: url('{{ asset("images/banner-catalogo.jpg") }}') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 40px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        /* CONTENEDOR */
        .container {
            width: 95%;
            margin: 30px auto;
        }

        /* GRID */
        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* CARD */
        .card {
            width: calc(25% - 20px);
            background: white;
            border-radius: 12px;
            padding: 15px;
            transition: 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .title {
            font-size: 15px;
            font-weight: 600;
            min-height: 40px;
        }

        .price {
            color: #e60023;
            font-size: 18px;
            font-weight: bold;
            margin-top: 5px;
        }

        .desc {
            font-size: 12px;
            color: #777;
            margin-top: 5px;
        }

        /* RESPONSIVE (por si lo ves en pantalla) */
        @media(max-width: 1024px){
            .grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media(max-width: 768px){
            .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>

    <!-- 🔥 BANNER -->
    <div class="banner">
        CATÁLOGO DE PRODUCTOS
    </div>

    <!-- 🧩 PRODUCTOS -->
    <div class="container">
        <div class="grid">
            @foreach($products as $product)
                <div class="card">

                    @if($product->first_image)
                        <img src="{{ asset('storage/'.$product->first_image) }}">
                    @endif

                    <div class="title">
                        {{ $product->name }}
                    </div>

                    <div class="price">
                        S/ {{ number_format($product->price, 2) }}
                    </div>

                    <div class="desc">
                        {{ \Illuminate\Support\Str::limit($product->description, 60) }}
                    </div>

                </div>
            @endforeach
        </div>
    </div>

</body>
</html>