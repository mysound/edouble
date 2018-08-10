<header>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a href="{{ url('/') }}" class="navbar-brand"><img alt="Brand" src="{{ asset('storage/images/logo/logo.png') }}" class="logo-header"></a>
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