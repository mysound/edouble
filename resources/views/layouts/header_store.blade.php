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
								<li><a href="{{ url('/store/' . $ganre->id) }}">{{ $ganre->title }}</a></li>
							@endforeach
						</ul>
					</li>
					<li><a href="{{ url('/store') }}">Shop</a></li>
					<li><a href="#">About</a></li>
					@if(Auth::user())
						<li role="presentation" class="dropdown active dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="botton" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="{{ route('home') }}">Home</a></li>
								@if(Auth::user()->admin)
									<li><a href="{{ route('admin.index') }}">Admin Dashboard</a></li>
								@endif
								<li>
		                            <a href="{{ route('logout') }}"
		                                onclick="event.preventDefault();
		                                         document.getElementById('logout-form').submit();">
		                                Logout
		                            </a>
		                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                                {{ csrf_field() }}
		                            </form>
		                        </li>
							</ul>
						</li>
					@else
						<li><a href="{{ route('login') }}">Login</a></li>
					@endif
				</ul>
				<a href="{{ Cart::count() ? route('cart.index') : route('shop') }}" class="btn btn-warning navbar-btn navbar-right"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge">{{ Cart::count() }}</span></a>
				<form method="POST" action="{{ route('store.search') }}" class="navbar-form navbar-right" role="search">
					{{ csrf_field() }}
					<div class="input-group">
						<input type="text" class="form-control" name="searchField" placeholder="Search">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</nav>
</header>