@extends('layouts.app_store')

@section('content')
	<div class="container b-cart__line">
		<div class="row">
			<div class="b-item__title">
				<h1>Checkout</h1>
			</div>
			@if(session()->has('message'))
			<br>
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
			@endif
			@if (count($errors))
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
		</div>
		<br>
		<div class="row">
			<div class="col-md-8">
				<div class="jumbotron" style="padding-bottom: 55px;">
					<span class="col-md-10">Items({{ $quantity }})</span>
					<span class="col-md-2 text-right">${{ $order->subtotal }}</span><br>
					<span class="col-md-10">Shipping</span>
					<span class="col-md-2 text-right">$0.00</span><br>
					<span class="col-md-10">Sales tax</span>
					<span class="col-md-2 text-right">${{ $order->total_tax}}</span><br>
					<hr>
					<p>
						<span class="col-md-10"><strong>Order total</strong></span>
						<span class="col-md-2 text-right"><strong>${{ $order->total }}</strong></span><br>
					</p>
					<a href="{{ route('store.contact') }}">Help & Contact</a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="jumbotron">
					<p><strong>Ship to</strong></p>
					<span>{{ $order->address->first_name.' '. $order->address->last_name }}</span><br>
					<span>{{ $order->address->address }}</span><br>
					<span>{{ $order->address->city.', '.$order->address->state->code.' '.$order->address->zip_code }}</span><br>
					<span>United States</span><br>
					<span>1234567890</span><br>
					<a href="{{ route('addresses.edit', $order->address->id) }}">Change</a>
				</div>
			</div>
			<div class="col-md-8">
				<div class="jumbotron">
					<p><strong>Review items and shipping</strong></p>
						@foreach($products as $product)
							<img src="{{ asset('storage/images/thumbnails/' . ($product->images->first()["title"] ? $product->images->first()["title"] : 'noimage.png')) }}" width="70">
							<span>{{ $product->name }} - {{ $product->title }} ({{ $product->category->title  }}) ${{ $product->price }} Qty {{ $product->pivot->quantity }}</span>
							<br>
							<br>
						@endforeach
					<br>
				</div>
			</div>
		</div>
	</div>
@endsection

