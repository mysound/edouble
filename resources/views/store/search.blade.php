@extends('layouts.app_store')

@section('content')

	<div class="container b-shopmain__line">
		<div class="row">
			<div class="col-md-12 b-breadcrumbs">
				<span><a href="{{ route('shop') }}">Doublesides</a></span>
				<span styles="font-size: 13px;">→</span>
				<span>Search</span>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row splitterline-bottom">
			<div class="col-md-3">
				<span class="h3 searchres_title">Search Result: {{ $products->total() }}</span>
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
				@if ($products->hasPages())
				    <ul class="pagination pagination">
				        {{-- Previous Page Link --}}
				        @if ($products->onFirstPage())
				            <li class="disabled"><span>«</span></li>
				        @else
				            <li><a href="{{ $products->previousPageUrl() }}" rel="prev">«</a></li>
				        @endif
				        @if($products->currentPage() > 3)
				            <li class="hidden-xs"><a href="{{ $products->url(1) }}">1</a></li>
				        @endif
				        @if($products->currentPage() > 4)
				            <li><span>...</span></li>
				        @endif
				        @foreach(range(1, $products->lastPage()) as $i)
				            @if($i >= $products->currentPage() - 2 && $i <= $products->currentPage() + 2)
				                @if ($i == $products->currentPage())
				                    <li class="active"><span>{{ $i }}</span></li>
				                @else
				                    <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
				                @endif
				            @endif
				        @endforeach
				        @if($products->currentPage() < $products->lastPage() - 3)
				            <li><span>...</span></li>
				        @endif
				        @if($products->currentPage() < $products->lastPage() - 2)
				            <li class="hidden-xs"><a href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a></li>
				        @endif
				        {{-- Next Page Link --}}
				        @if ($products->hasMorePages())
				            <li><a href="{{ $products->nextPageUrl() }}" rel="next">»</a></li>
				        @else
				            <li class="disabled"><span>»</span></li>
				        @endif
				    </ul>
				@endif
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
							<li><a href="{{ route('store.search', ['category_id' => 2, 'ganre_id' => $ganre_id, 'searchField' => $searchField, 'min_price' => $min_price, 'max_price' => $max_price]) }}">Records Vinyl</a></li>
							<li><a href="{{ route('store.search', ['category_id' => 3, 'ganre_id' => $ganre_id, 'searchField' => $searchField, 'min_price' => $min_price, 'max_price' => $max_price]) }}">CD, DVD & Blu-Ray</a></li>
							<li><a href="{{ route('store.search', ['searchField' => $searchField, 'ganre_id' => $ganre_id, 'min_price' => $min_price, 'max_price' => $max_price]) }}">All categories</a></li>
						</ul>
					</div>
					<div class="splitterline-top b-search__price">
						<div class="b-searh-title">
							<h4>Price</h4>
						</div>
						<div>
							<form method="GET" action="{{ route('store.search') }}">
								{{ csrf_field() }}
								<div class="b-priceField">
									$&nbsp;<input type="text" name="min_price" class="priceField" value="{{ $min_price or "" }}">
									to&nbsp;$&nbsp;<input type="text" name="max_price" class="priceField" value="{{ $max_price or "" }}">
								</div>
								@if($ganre_id)
									<input type="hidden" name="ganre_id" value="{{ $ganre_id }}">
								@endif
								@if($category_id)
									<input type="hidden" name="category_id" value="{{ $category_id }}">
								@endif
								<input type="hidden" name="searchField" value="{{ $searchField }}">
								<div class="b-search__button">
									<button type="submit" class="btn btn-success">Search</button>
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
						<div class="b-main-item-title">
							<a href="{{ route('product.view', ['product' => $product->id]) }}">
								<h5>{{ str_limit($product->title, 51) }}</h5>
								<h5>{{ str_limit($product->name, 51) }}</h5>
							</a>
						</div>
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
				@if ($products->hasPages())
				    <ul class="pagination pagination">
				        {{-- Previous Page Link --}}
				        @if ($products->onFirstPage())
				            <li class="disabled"><span>«</span></li>
				        @else
				            <li><a href="{{ $products->previousPageUrl() }}" rel="prev">«</a></li>
				        @endif
				        @if($products->currentPage() > 3)
				            <li class="hidden-xs"><a href="{{ $products->url(1) }}">1</a></li>
				        @endif
				        @if($products->currentPage() > 4)
				            <li><span>...</span></li>
				        @endif
				        @foreach(range(1, $products->lastPage()) as $i)
				            @if($i >= $products->currentPage() - 2 && $i <= $products->currentPage() + 2)
				                @if ($i == $products->currentPage())
				                    <li class="active"><span>{{ $i }}</span></li>
				                @else
				                    <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
				                @endif
				            @endif
				        @endforeach
				        @if($products->currentPage() < $products->lastPage() - 3)
				            <li><span>...</span></li>
				        @endif
				        @if($products->currentPage() < $products->lastPage() - 2)
				            <li class="hidden-xs"><a href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a></li>
				        @endif
				        {{-- Next Page Link --}}
				        @if ($products->hasMorePages())
				            <li><a href="{{ $products->nextPageUrl() }}" rel="next">»</a></li>
				        @else
				            <li class="disabled"><span>»</span></li>
				        @endif
				    </ul>
				@endif
			</div>
		</div>
	</div>

@endsection