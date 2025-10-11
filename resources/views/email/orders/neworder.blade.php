@component('mail::message')
# ¡NUEVO PEDIDO GENERADO DESDE LA WEB!

CLIENTE: {{ $order->customer_name }}
PEDIDO: **{{ $order->id }}**

**Total:** S/ {{ number_format($order->total, 2) }}

## Productos
@foreach($order->items as $item)
- {{ $item->product_name }} (x{{ $item->quantity }}) - S/ {{ number_format($item->subtotal, 2) }}
@endforeach

Te contactaremos pronto para coordinar el envío.

Gracias,  
{{ config('app.name') }}
@endcomponent

