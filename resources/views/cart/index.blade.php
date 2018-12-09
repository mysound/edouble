@extends('layouts.app_store')

@section('content')
	<div class="container b-cart__line">
		<div class="b-item__title">
			<h1>Your Shopping Cart</h1>
		</div>
		@if (count($errors))
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		@if(Cart::count() > 0)
			<div class="b-cart__step">Step 1: Edit Cart</div>
			@if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
			@endif
			<div>
				<h4>{{ Cart::count() }} Item(s) in Shopping Cart
				<a href="{{ route('cart.empty') }}" class="pull-right text-danger">Empty Cart</a>
				</h4>
			</div>
			<table class="table table-striped cart-tabel">
				<thead>
					<tr>
						<th></th>
						<th>Qty</th>
						<th class="hidden-xs">Image</th>
						<th>Name</th>
						<th>Each</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Cart::content() as $product)
						<tr>
							<td>
								<form method="POST" action="{{ route('cart.destroy', $product->rowId) }}">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="submit" class="btn btn-default t-btnrem">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
									</button>
								</form>
							</td>
							<td>								
								<form method="POST" action="{{ route('cart.update', $product->rowId) }}">
									{{ csrf_field() }}
									{{ method_field('PUT') }}
									<input class="inputqty" type="qty" name="qty" value="{{ $product->qty }}" size="1"><br>
									<button type="submit" class="btn btn-default t-btnref">
										<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
									</button>
								</form>
							</td>
							<td class="hidden-xs"><a href="{{ route('product.view', $product->model->id) }}"><img src="{{ asset('storage/images/thumbnails/' . $product->model->images->first()['title']) }}" width="40" class="gallery__img"></a></td>
							<td>
								<a href="{{ route('product.view', $product->model->id) }}">{{ $product->name }}</a><br>
								<p><small class="text-danger"><em>Usually ships in 7-10 business days</em></small></p>
							</td>
							<td>{{ $product->price }}</td>
							<td>{{ $product->subtotal }}</td>
						</tr>
					@endforeach
					<tr class="info">
						<td></td>
						<td></td>
						<td class="hidden-xs"></td>
						<td></td>
						<td><strong>Subtotal</strong></td>
						<td><strong>{{ Cart::subtotal() }}</strong></td>
					</tr>
					<tr class="info">
						<td></td>
						<td></td>
						<td class="hidden-xs"></td>
						<td></td>
						<td><strong>Shipping</strong></td>
						<td><strong>$0.00</strong></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td></td>
						<td class="hidden-xs"></td>
						<td></td>
						<td><strong>Total</strong></td>
						<td><strong>{{ Cart::subtotal() }}</strong></td>
					</tr>
				</tbody>
			</table>
			<div class="b-cart__step">Step 2: Shipping Method</div>
			<div class="row">
				<div class="col-md-4">
					<div class="b-shipping-form">
						<table class="table shippingtable">
							<tbody>
								<tr>
									<td>
										<input type="radio" name="shipping" id="freeshipping" value="freeshipping" checked>
									</td>
									<td>Free Shipping</td>
									<td>$0.00</td>
								</tr>
								{{-- <tr>
									<td>
										<input type="radio" name="shipping" id="upsshipping" value="upsshipping">
									</td>
									<td>UPS Shipping</td>
									<td>$10.00</td>
								</tr> --}}
							</tbody>
						</table>
						<button type="submit" class="btn btn-primary">
							<span class="glyphicon glyphicon-refresh btnshippingupdate"></span>
							Update Shipping
						</button>
					</div>
				</div>
				<div class="hidden-xs col-md-2 b-shipping-separator"></div>
				<div class="col-md-6">Shipping info: On any order containing multiple items, the approximated shipping date is subject to the longest listed time for any item within the order, including pre-orders and awaiting repress items. <br>Please call for details:</div>
			</div>
			<div class="b-cart__step">Step 3: Shipping addres</div>
			<form method="POST" action="{{ route('order.store') }}">
				{{ csrf_field() }}
				<div class="row">
					@if($addresses)
						<div class="col-md-12">
							<div class="b-shipping-form">
								<table class="table shippingtable">
									<tbody>
										@foreach($addresses as $address)
											<tr>
												<td>
													<input type="radio" name="address" id="address" value="{{ $address->id }}" required="">
												</td>
												<td>{{ $address->first_name.' '.$address->last_name }}</td>
												<td>{{ $address->address.', '.$address->city.', '.$address->state.', '.$address->zip_code}}</td>
												<td>{{ $address->phone }}</td>
												<td><a href="{{ route('addresses.edit', $address->id) }}">edit</a></td>
											</tr>
										@endforeach
										<tr>
											<td colspan="5"><a href="{{ route('addresses.create') }}">Add Another</a></td>
										</tr>
									</tbody>
								</table>								
							</div>
						</div>						
					@else
						<div class="col-md-4">
							<label for="">First Name</label>
							<input class="form-control" type="text" name="first_name" placeholder="First Name" value="" required="">
						</div>
						<div class="col-md-4">
							<label for="">Last Name</label>
							<input class="form-control" type="text" name="last_name" placeholder="Last Name" value="" required="">
						</div>
						<div class="col-md-4">
							<label for="">Email</label>
							<input class="form-control" type="text" name="email" placeholder="Email" value="" required="">
						</div>
						<div class="col-md-4">
							<label for="">Address</label>
							<input class="form-control" type="text" name="address" placeholder="Address" value="" required="">
						</div>
						<div class="col-md-4">
							<label for="">Country</label>
							<input class="form-control" type="text" name="country_id" placeholder="Country" value="" required="">
						</div>
						<div class="col-md-4">
							<label for="">City</label>
							<input class="form-control" type="text" name="city" placeholder="City" value="" required="">
						</div>
						<div class="col-md-4">
							<label for="">State</label>
							<input class="form-control" type="text" name="state" placeholder="State" value="" required="">
						</div>
						<div class="col-md-4">
							<label for="">Zip Code</label>
							<input class="form-control" type="text" name="zip_code" placeholder="Zip Code" value="" required="">
						</div>
						<div class="col-md-4">
							<label for="">Phone</label>
							<input class="form-control" type="text" name="phone" placeholder="Phone" value="" required="">
						</div>
					@endif
				</div>
				<div class="b-cart__step">Step 4: Proceed to Secure Checkout</div>
				<button type="submit" class="btn btn-success btn-block">
					Checkout
				</button>
			</form>
			{{-- <div class="row b-btnpaypal__line">
				<span class="btnpaypal">
					<input type="Image" name="paypalbtn" src="{{ asset('storage/images/icons/checkout-logo-large-en.png') }}">
				</span>
			</div> --}}
		@else
			<br>
			<div class="alert alert-warning">
				<p>Your Shopping Cart Is Empty! <a href="{{ route('shop') }}">Back To The Shop</a></p>
			</div>
		@endif
	</div>

@endsection