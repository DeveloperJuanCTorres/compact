<!DOCTYPE html>
<html>
<head>
    <title>Catálogo</title>
    <meta charset="utf-8">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background: #f5f5f5;
        }

        /* 🔥 BOTÓN IMPRIMIR */
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: black;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 8px;
        }

        /* 🔥 BANNER */
        .banner {
            width: 100%;
            height: 250px;
            background: url('{{ asset("images/banner-catalogo.jpg") }}') center/cover no-repeat;
        }

        /* CONTENEDOR */
        .container {
            width: 95%;
            margin: 30px auto;
        }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            break-inside: avoid;
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: contain;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px;
        }

        .price {
            color: red;
            font-weight: bold;
        }

        .desc {
            font-size: 12px;
            color: #666;
        }

        /* 🖨️ MODO IMPRESIÓN */
        @media print {

            .print-btn {
                display: none;
            }

            body {
                background: white;
            }

            .container {
                width: 100%;
                margin: 0;
            }

            .grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 10px;
            }

            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }

            .banner {
                height: 150px;
            }
        }
    </style>
</head>
<body>

    <!-- 🔘 BOTÓN -->
    <button class="print-btn" onclick="window.print()">
        Guardar / Imprimir PDF
    </button>

    <!-- 🔥 BANNER -->
    <div class="banner"></div>

    <!-- 🧩 PRODUCTOS -->
    <div class="container">
        <div class="grid">
            @foreach($products as $product)
                <div class="card">

                    @if($product->first_image)
                        <img src="{{ asset('storage/'.$product->first_image) }}">
                    @endif

                    <div class="title">{{ $product->name }}</div>
                    <div class="price">S/ {{ number_format($product->price, 2) }}</div>
                    <div class="desc">
                        {{ \Illuminate\Support\Str::limit($product->description, 60) }}
                    </div>

                </div>
            @endforeach
        </div>
    </div>

</body>
</html>