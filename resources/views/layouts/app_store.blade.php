<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DoubleSides Inc') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body class="b-page">

	@include('layouts.header_store')
	
	<div id='app'></div>

	@yield('content')
	
	<footer class="bs-docs-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<ul class="bs-docs-footer-links">
						<li><a href="#">About Us</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Contact Us</a></li>
						<li><a href="#">Shipping</a></li>
						<li><a href="#">Privacy Policy</a></li>
					</ul>
					<p>DoubleSides inc. - All Rights Reserved.</p>
				</div>
				<div class="col-md-4">
					<div class="socials_media">
						<a href="#" class="icon-fb"></a>
						<a href="#" class="icon-paypal"></a>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="{{ asset('js/app.js') }}"></script>
	@yield('script')
</body>
</html>