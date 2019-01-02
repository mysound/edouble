@extends('layouts.app_store')

@section('content')

	<div class="container b-shopmain__line">
		<div class="row">
			<div class="col-md-12 b-breadcrumbs">
				<span><a href="#">Doublesides</a></span>
				<span styles="font-size: 13px;">→</span>
				<span>Search</span>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row splitterline-bottom">
			<div class="col-md-3">
				<span class="h3 searchres_title">Search Result: 18</span>
			</div>
			{{-- <div class="col-md-5">
				<div class="b-sortby">
					<form class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-sm-4" for="sortby1">Sort By</label>
							<div class="col-sm-8">
								<select class="form-control" id="sortby1">
									<option>Popularity</option>
									<option>Lowest Price</option>
									<option>Highest Price</option>
								</select>
							</div>
						</div>
					</form>
				</div>
			</div> --}}
			<div class="visible-md visible-lg col-md-9 pagenav">
				<nav aria-label="Page navigation">
					{{ $products->links() }}
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="visible-md visible-lg col-md-3 b-filter">
				<div class="b-search-categories">
					<div class="splitterline-bottom b-searh-title">
						<h4>Search Categories</h4>
					</div>
					<div class="b-search__checkbox">
						<ul>
							<li><a href="#">Records Vinyl</a></li>
							<li><a href="#">CD, DVD & Blu-Ray</a></li>
							<li><a href="#">All categories</a></li>
						</ul>
					</div>
					<div class="splitterline-top b-search__price">
						<div class="b-searh-title">
							<h4>Price</h4>
						</div>
						<div>
							<form>
								<div class="b-priceField">
									$&nbsp;<input type="" name="" class="priceField">
									to&nbsp;$&nbsp;<input type="" name="" class="priceField">
								</div>
								<div class="b-search__button">
									<button type="button" class="btn btn-success">Search</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			@foreach($products as $product)
				<div class="col-xs-6 col-sm-6 col-md-3">
					<div class="b-main__item center-block text-center">
						<div class="b-main-item-img center-block">
							<a href="{{ route('product.view', ['product' => $product->id]) }}"><img src="{{ asset('storage/images/thumbnails/' . ($product->images->first()["title"] ? $product->images->first()["title"] : 'noimage.png')) }}"></a>
						</div>
						<a href="{{ route('product.view', ['product' => $product->id]) }}">
							<h5>{{ $product->title }}</h5>
							<h5>{{ $product->name }}</h5>
						</a>
						<p class="h4">${{ $product->price }}</p>
						<form method="POST" action="{{ route('cart.store') }}">
							{{ csrf_field() }}
							<input type="hidden" name="product_id" value="{{ $product->id }}">
							<button type="submit" class="btn btn-warning">Buy Now</button>
						</form>
					</div>
				</div>
			@endforeach

			
		</div>
		<div class="row splitterline">
			<div class="col-md-12 pagenav">
				<nav aria-label="Page navigation">
					{{ $products->links() }}
				</nav>
			</div>
		</div>
	</div>

@endsection