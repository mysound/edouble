<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>DoubleSides Inc</title>
	<link href="css/app.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
</head>
<body class="b-page">
	<header>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a href="#" class="navbar-brand"><img alt="Brand" src="{{ asset('storage/images/logo/logo.png') }}" class="logo-header"></a>
					<button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mydropdown">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="mydropdown">
					<ul class="nav navbar-nav">
						<li role="presentation" class="dropdown active dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="botton" aria-haspopup="true" aria-expanded="false">Genres<span class="caret"></span></a>
							<ul class="dropdown-menu">
								@foreach ($ganres as $ganre)
									<li><a href="#">{{ $ganre->title }}</a></li>
								@endforeach
							</ul>
						</li>
						<li><a href="#">Shop</a></li>
						<li><a href="#">New Arrivals</a></li>
						<li><a href="#">Pre-Order</a></li>
						<li><a href="#">About</a></li>
					</ul>
					<button class="btn btn-warning navbar-btn navbar-right"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge">3</span></button>
					<form class="navbar-form navbar-right" role="search">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
							</span>
						</div>
					</form>
				</div>
			</div>
		</nav>
	</header>
	<div id='app'></div>
	<div class="container b-slider__line">
		<div class="row">
			<div class="col-md-6 b-slider-line__jumbotron">
				<div class="jumbotron b-slider-line-jumbotron">
					<h3>DoubleSides</h3>
					<p>EXCLUSIVE VINYL & CDs</p>
					<p><img src="{{ asset('storage/images/icons/shipping.ico') }}" class="jumbotron_shipping_img"> Free Shipping</p>
				</div>
			</div>
			<div class="col-md-6 b-slider-line-slider">
				<div class="carousel slide" id="myslider" data-ride="carousel">
					<ol class="carousel-indicators">
						@for($i = 0; $i < $slides->count(); $i++)
							<li data-target="#myslider" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
						@endfor
					</ol>

					<div class="carousel-inner thumbnail">
						@foreach($slides as $key => $slide)
							<div class="item {{ $key == 0 ? 'active' : '' }}">
								<a href="#"><img src="{{ asset('storage/images/' . $slide->images->first()["title"]) }}"></a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container b-main__line">
		<div class="b-main-line__title thumbnail"><span class="h3"><a href="#">Vinyl</a></span></div>
		<div class="row">
			@foreach($lps as $lp)
				<div class="col-xs-6 col-sm-4 col-md-3">
					<div class="b-main__item center-block text-center">
						<div class="b-main-item-img center-block">
							<a href="#"><img src="{{ asset('storage/images/' . $lp->images->first()["title"]) }}"></a>
						</div>
						<a href="#"><h5>{{ $lp->title }}</h5></a>
						<a href="#"><h5>{{ $lp->name }}</h5></a>
						<p class="h4">${{ $lp->price }}</p>
						<button type="button" class="btn btn-warning">Buy Now</button>
					</div>
				</div>
			@endforeach
		</div>
		<div class="b-main-line__title thumbnail"><span class="h3"><a href="#">CD, DVD & Blu-Ray</a></span></div>
		<div class="row">
			@foreach($discs as $disc)
				<div class="col-xs-6 col-sm-6 col-md-3">
				<div class="b-main__item center-block text-center">
					<div class="b-main-item-img center-block">
						<a href="#"><img src="{{ asset('storage/images/' . $disc->images->first()["title"]) }}"></a>
					</div>
					<a href="#"><h5>{{ $disc->title }}</h5></a>
					<a href="#"><h5>{{ $disc->name }}</h5></a>
					<p class="h4">${{ $disc->price }}</p>
					<button type="button" class="btn btn-warning">Buy Now</button>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	
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
	<script src="js/app.js"></script>
</body>
</html>