@component('mail::message')
# ¡Gracias por tu compra!

Hola {{ $order->customer_name }}, tu pedido **{{ $order->id }}** ha sido confirmado.

**Total:** S/ {{ number_format($order->total, 2) }}

## Productos
@foreach($order->items as $item)
- {{ $item->product_name }} (x{{ $item->quantity }}) - S/ {{ number_format($item->subtotal, 2) }}
@endforeach

Te contactaremos pronto para coordinar el envío.

Gracias,  
{{ config('app.name') }}
@endcomponent

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmación</title>
    </head>
    <body>
        <img src="https://compactseguridad.com/img/compact.png" width='420' height='160' />
        <div style="text-align: center;">
            <h5 class="text-center">¡Gracias por tu compra!</h5>
        </div>
        <span>Hola {{ $order->customer_name }}, tu pedido **{{ $order->id }}** ha sido confirmado.</span>
        <span>**Total:** S/ {{ number_format($order->total, 2) }}</span>

        <h5>Productos</h5>
        @foreach($order->items as $item)
        <span>- {{ $item->product_name }} (x{{ $item->quantity }}) - S/ {{ number_format($item->subtotal, 2) }}</span>
        @endforeach

        <h5 class="text-center">Te contactaremos pronto para coordinar el envío.</h5>
        
    </body>
</html>