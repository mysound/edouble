@extends('layouts.app_store')

@section('style')
	<style>
		.b-page {
			background: #ccc;
		}
	</style>
@endsection

@section('content')
	<div class="container b-slider__line">
		<div class="row">
			<div class="visible-lg visible-md col-md-6 b-slider-line__jumbotron">
				<div class="jumbotron b-slider-line-jumbotron text-center">
					<h1 class="b-slider-line-jumbotron-h1" style="font-size: 3.9em">DoubleSides</h1>
					<p class="b-slider-line-jumbotron-p" style="font-size: 1.85em">Exclusive Vinyl & CDs</p>
				</div>
			</div>
			<div class="visible-xs col-md-6 b-slider-line__jumbotron">
				<div class="jumbotron b-slider-line-jumbotron text-center">
					<h1 class="b-slider-line-jumbotron-h1">DoubleSides</h1>
					<p class="b-slider-line-jumbotron-p">Exclusive Vinyl & CDs</p>
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
								<a href="{{ $slide->product_id ? route('product.view', ['product' => $slide->product_id]) : url('/') }}"><img src="{{ asset('storage/images/' . $slide->images->first()["title"]) }}"></a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container b-main__line">
	@if(session()->has('message'))
		<div class="alert alert-success">
			{{ session()->get('message') }}
		</div>
	@endif
		<div class="b-main-line__title thumbnail"><span class="h3"><a href="{{ route('store.search', ['category_id' => 2]) }}">Vinyl</a></span></div>
		<div class="row">
			@foreach($lps as $lp)
				<div class="col-xs-6 col-sm-4 col-md-3">
					<div class="b-main__item center-block text-center">
						<div class="b-main-item-img center-block">
							<a href="{{ route('product.view', ['product' => $lp->id]) }}"><img src="{{ asset('storage/images/thumbnails/' . ($lp->images->first()["title"] ? $lp->images->first()["title"] : 'noimage.png')) }}"></a>
						</div>
						<div class="b-main-item-title">
							<a href="{{ route('product.view', ['product' => $lp->id]) }}">
								<h5>{{ str_limit($lp->title, 51) }}</h5>
								<h5>{{ str_limit($lp->name, 51) }}</h5>
							</a>
						</div>
						<p class="h4">${{ $lp->price }}</p>
						<form method="POST" action="{{ route('cart.store') }}">
							{{ csrf_field() }}
							<input type="hidden" name="product_id" value="{{ $lp->id }}">
							<button type="submit" class="btn btn-warning">Buy Now</button>
						</form>
					</div>
				</div>
			@endforeach
		</div>
		<div class="b-main-line__title thumbnail"><span class="h3"><a href="{{ route('store.search', ['category_id' => 3]) }}">CD, DVD & Blu-Ray</a></span></div>
		<div class="row">
			@foreach($discs as $disc)
				<div class="col-xs-6 col-sm-6 col-md-3">
				<div class="b-main__item center-block text-center">
					<div class="b-main-item-img center-block">
						<a href="{{ route('product.view', ['product' => $disc->id]) }}"><img src="{{ asset('storage/images/thumbnails/' . ($disc->images->first()["title"] ? $disc->images->first()["title"] : 'noimage.png')) }}"></a>
					</div>
					<div class="b-main-item-title">
						<a href="{{ route('product.view', ['product' => $disc->id]) }}">
							<h5>{{ str_limit($disc->title, 51) }}</h5>
							<h5>{{ str_limit($disc->name, 51) }}</h5>
						</a>
					</div>
					<p class="h4">${{ $disc->price }}</p>
					<form method="POST" action="{{ route('cart.store') }}">
						{{ csrf_field() }}
						<input type="hidden" name="product_id" value="{{ $disc->id }}">
						<button type="submit" class="btn btn-warning">Buy Now</button>
					</form>
				</div>
			</div>
			@endforeach
		</div>
	</div>
@endsection