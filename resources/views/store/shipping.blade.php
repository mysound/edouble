@extends('layouts.app_store')

@section('content')
	<div class="container b-item__line">
		<div class="b-item__title">
			<h1>Shipping rates</h1>
		</div>
		<div><br>
			<p>This current moment all domestic shippings are FREE. We use USPS as our delivery service. Upon a request a delivery can be made thru FEDEX or UPS</p>
			<p>IF a buyer would like we can ship PRiORITY or FIRST CLASS mail. In this case a buyer has to make a payment for this requested shipping.</p>
			<p>We ship USPS MEDIA MAIL 1 - 4 business days all LPs and CDs FIRST CLASS 1 - 2 business days.</p>
			<p>Non-domestic shipping can be done only by special request and paid by a buyer.</p>
			<p>Please be prepared to pay the Customs Duty your country charges. We are not and cannot be responsible for what your country charges. We do not declare packages at less than paid value.</p><br>
			<p class="text-center"><img src="{{ asset('storage/images/logo/logo2.png') }}" alt="Logo" class="img-circle" width="110"></p>
		</div>
	</div>	
@endsection