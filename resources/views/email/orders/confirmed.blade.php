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