@extends('layouts.app_store')

@section('content')

	<div class="container b-item__line">
		<div class="b-item__title">
			<h1>{{ $product->title }} - {{ $product->category->title }} by <a href="/store?searchField={{ $product->name }}">{{ $product->name }}</a></h1>
		</div>
		<div class="row" style="margin-top: 15px;">
			<div class="col-sm-6 col-md-5 b-item-gallery">
				<div class="b-item-img">
					<img src="{{ asset('storage/images/' . ($product->images->first()["title"] ? $product->images->first()["title"] : 'noimage.png')) }}" class="img-responsive" alt="no image for the item" id="largeImage">
				</div>
				<div class="b-gallery" id="thumbs">
					@foreach($product->images as $image)
						<img src="{{ asset('storage/images/' . $image->title) }}" width="60" class="gallery__img">
					@endforeach
				</div>
			</div>
			<div class="col-sm-6 col-md-3 col-md-push-4 b-item-addtocart" style="text-align: center;">
				<div class="b-addtocart">
					<div class="b-price h3">
						<span>${{ $product->price }}</span>
					</div>
					<div class="b-addbtn">
						<form method="POST" action="{{ route('cart.store') }}" >
							{{ csrf_field() }}
							<input type="hidden" name="product_id" value="{{ $product->id }}">
							<input type="submit" class="btn btn-warning btn-addbtn" value="Add To Cart">
							{{-- <button type="button" class="btn btn-warning btn-addbtn">Add To Cart</button> --}}
						</form>
					</div>
				</div>
				<div class="free-shipping">Free shipping</div>
			</div>
			<div class="col-sm-6 col-md-4 col-md-pull-3 b-item-param">
				<div class="b-param">
					<ul class="b-param__list">
						<li><span>Label: </span>{{ $product->brand->title or ""}}</li>
						<li><span>Genre: </span>{{ $product->ganre->title or "" }}</li>
						<li><span>Description: </span>{{ $product->short_description or "" }}</li>
						<li><span>Release Date: </span>{{ $product->release_date or "" }}</li> 
						<li><span>UPC: </span>{{ $product->upc or "" }}</li> 
						<li class="{{ $product->quantity ? 'instock' : 'outofstok' }}"><span>{{ $product->quantity ? 'In Stock' : 'Out of Stock' }}</span></li>
						@if(Auth::user() && Auth::user()->admin)
								<li><a href="{{ route('admin.product.edit', $product->id) }}"><span class="glyphicon glyphicon-edit"></span> Revise this item</a></li>
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container b-description__line">
		<ul class="nav nav-tabs nav-justified">
			<li class="active"><a href="#tab-1" data-toggle="tab">Description</a></li>
			{{-- <li><a href="#tab-2" data-toggle="tab">Track Listing</a></li>
			<li><a href="#tab-3" data-toggle="tab">Video</a></li>
			<li><a href="#tab-4" data-toggle="tab">Reviews</a></li> --}}
		</ul>
		<div class="tab-content">
			<div class="tab-pane b-description active" id="tab-1">
				<p>{{ $product->description or $product->name . ' - ' . $product->title }}</p>
			</div>
			{{-- <div class="tab-pane b-description" id="tab-2">
				<p>
					A1	Cluster One	5:58<br>
					A2	What Do You Want From Me	4:21<br>
					A3	Poles Apart	7:04<br>
					B1	Marooned	5:29<br>
					B2	A Great Day For Freedom	4:17<br>
					B3	Wearing The Inside Out	6:49<br>
					C1	Take It Back	6:12<br>
					C2	Coming Back To Life	6:19<br>
					C3	Keep Talking	6:11<br>
					D1	Lost For Words	5:14<br>
					D2	High Hopes	8:31<br>
				</p>
			</div>
			<div class="tab-pane b-description" id="tab-3">Video</div>
			<div class="tab-pane b-description" id="tab-4">Reviews</div> --}}
		</div>
	</div>
	<div class="container b-also__line">
		<span class="h3">Customers who bought {{ $product->title }}, also bought:</span>
		<div class="row" style="margin-top: 15px;">
			@foreach($items as $item)
				<div class="col-xs-6 col-sm-6 col-md-3">
					<div class="b-main__item center-block text-center">
						<div class="b-main-item-img center-block">
							<a href="{{ route('product.view', ['product' => $item->id]) }}"><img src="{{ asset('storage/images/thumbnails/' . ($item->images->first()["title"] ? $item->images->first()["title"] : 'noimage.png')) }}"></a>
						</div>
						<div class="b-main-item-title">
							<a href="{{ route('product.view', ['product' => $item->id]) }}">
								<h5>{{ str_limit($item->title, 51) }}</h5>
								<h5>{{ str_limit($item->name, 51) }}</h5>
							</a>
						</div>
						<p class="h4">${{ $item->price }}</p>
						<form method="POST" action="{{ route('cart.store') }}">
							{{ csrf_field() }}
							<input type="hidden" name="product_id" value="{{ $item->id }}">
							<button type="submit" class="btn btn-warning">Buy Now</button>
						</form>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		$("#thumbs").delegate("img", "click", function(){
		    $("#largeImage").attr("src",$(this).attr("src").replace("thumb","large"));
		});
	</script>
@endsection