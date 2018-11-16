@extends('layouts.app_store')

@section('content')
	<div class="container b-cart__line">
		<div class="b-item__title">
			<h1>Your Oredr</h1>
		</div>
		@if(session()->has('message'))
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
		<br>
		<div class="row">
			<div class="jumbotron">
				<p>Items:</p>
				<ul>
					@foreach($products as $product)
						<li>
							<p>
							<img src="{{ asset('storage/images/thumbnails/' . $product->images->first()["title"]) }}" width="50">
								{{ $product->name }} - {{ $product->title }}
								({{ $product->category->title  }})
								
							</p>
						</li>
					@endforeach
					
				</ul>
				<p>Shipping address: <br>{{ $order->shipping_address }}</p>
				<p>Order total: ${{ $order->total }}</p>
				<a href="#"><input type="Image" name="paypalbtn" src="{{ asset('storage/images/icons/checkout-logo-large-en.png') }}"></a>
			</div>
		</div>
	</div>
@endsection