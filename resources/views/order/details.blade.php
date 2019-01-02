@extends('layouts.app_store')

@section('content')
	<div class="container b-cart__line">
		<div class="row">
			<div class="b-item__title">
				<h1>Order details</h1>
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
			<div class="col-md-12"><p><a href="{{ route('home') }}">Home</a></p></div>
			<div class="col-md-8">
				<div class="jumbotron" style="padding-bottom: 55px;">
					<span class="col-md-10">Items({{ $quantity }})</span>
					<span class="col-md-2 text-right">${{ $order->total }}</span><br>
					<span class="col-md-10">Shipping</span>
					<span class="col-md-2 text-right">$0</span><br>
					<hr>
					<p>
						<span class="col-md-10"><strong>Order total</strong></span>
						<span class="col-md-2 text-right"><strong>${{ $order->total }}</strong></span><br>
					</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="jumbotron">
					<p><strong>Shipping address</strong></p>
					<span>{{ $order->shipping_address }}</span>
				</div>
			</div>
			<div class="col-md-8">
				<div class="jumbotron">
					<p><strong>Order items</strong></p>
						@foreach($products as $product)
							<img src="{{ asset('storage/images/thumbnails/' . ($product->images->first()["title"] ? $product->images->first()["title"] : 'noimage.png')) }}" width="70">
							<span>{{ $product->name }} - {{ $product->title }} ({{ $product->category->title  }}) ${{ $product->price }} Qty {{ $product->pivot->quantity }}</span>
							<br>
							<br>
						@endforeach
					<br>
				</div>
			</div>
			<div class="col-md-4">
				<div class="jumbotron">
					<p><strong>Shipping details</strong></p>
					@if($order->shipping_no)
						<span><strong>Tracking number:</strong> {{ $order->shipping_no }}</span><hr>
						<span><strong>Shipping status:</strong> Shipped</span><br>
						<span><strong>Shipping carrier:</strong> UPS</span>
					@else
						<span class="text-success"><strong>Awaiting shipment</strong></span>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection