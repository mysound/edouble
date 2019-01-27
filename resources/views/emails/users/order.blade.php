@component('mail::message')
Thank you for your purchase!

Order # {{ $order->id }}<br>

Shipping address:<br>
{{ $address->first_name }} {{ $address->last_name }},<br>
{{ $address->address }},<br>
{{ $address->city }}, {{ $address->state->code }},<br>
{{ $address->zip_code }},<br>
{{ $address->country->name }},<br>
{{ $address->phone }}


@component('mail::table')
| Title        | Qty    | Price    |
|:-------------|:------:| --------:|
@foreach($products as $product)
| {{ $product->name }} - {{ $product->title }} ({{ $product->category->title }}) | {{ $product->pivot->quantity }} | ${{ $product->price }} |
@endforeach
@endcomponent
Sales tax: ${{ $order->total_tax }}<br>
Total: ${{ $order->total }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
