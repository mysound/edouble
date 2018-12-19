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
					<span class="col-md-2 text-right">${{ $order->total }}</span><br>
					<span class="col-md-10">Shipping</span>
					<span class="col-md-2 text-right">$0</span><br>
					<hr>
					<p>
						<span class="col-md-10"><strong>Order total</strong></span>
						<span class="col-md-2 text-right"><strong>${{ $order->total }}</strong></span><br>
					</p>
					<form method="POST" action="{{ route('create-payment') }}">
						{{ csrf_field() }}
						<input type="hidden" name="orderID" value="{{ $order->id }}">
						<input type="submit" value="Pay Now" class="btn btn-success">
					</form>
					{{-- <div id="paypal-button"></div> --}}
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
							<img src="{{ asset('storage/images/thumbnails/' . $product->images->first()["title"]) }}" width="50">
							<span>{{ $product->name }} - {{ $product->title }} ({{ $product->category->title  }}) ${{ $product->price }} Qty {{ $product->pivot->quantity }}</span>
							<br>
							<br>
						@endforeach
					<br>
					{{-- <div id="paypal-button"></div> --}}
				</div>
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