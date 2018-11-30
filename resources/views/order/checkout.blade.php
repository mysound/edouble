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
				<form method="POST" action="{{ route('create-payment') }}">
					{{ csrf_field() }}
					<input type="hidden" name="orderID" value="{{ $order->id }}">
					<input type="submit" value="Pay Now" class="btn btn-success">
				</form>
				<br>
				<div id="paypal-button"></div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
	<script>
		paypal.Button.render({
			env: 'sandbox', // Or 'production'
			style: {
				size: 'large',
				color: 'gold',
				shape: 'pill',
			},
			// Set up the payment:
			// 1. Add a payment callback
			payment: function(data, actions) {
			// 2. Make a request to your server
				return actions.request.post('/api/create-payment/', {
					orderID: {{ $order->id }}
				})
					.then(function(res) {
					// 3. Return res.id from the response
					return res.id;
			    });
			},
			// Execute the payment:
			// 1. Add an onAuthorize callback
			onAuthorize: function(data, actions) {
			// 2. Make a request to your server
				return actions.request.post('/api/execute-payment/', {
					paymentID: data.paymentID,
					payerID:   data.payerID,
					orderID: {{ $order->id }}
				})
					.then(function(res) {
						window.location.replace("{{ route('payment-approved')}}");
						//alert('Thank you for your purchase!');
						// 3. Show the buyer a confirmation message.
					});
			}
		}, '#paypal-button');
	</script>
@endsection