@component('mail::message')
Payment received

Status: <strong style="color: {{ $status == 'completed' ? 'green' : 'red' }}">{{ $status }}</strong>

Order # {{ $order->id }}<br>

Ship to:<br>
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
| {{ $product->name }} - {{ $product->title }} ({{ $product->category->title }}) <br> {{ $product->sku }} | {{ $product->pivot->quantity }} | ${{ $product->price }} |
@endforeach
@endcomponent

Sales tax: ${{ $order->total_tax }}<br>
Total: ${{ $order->total }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
