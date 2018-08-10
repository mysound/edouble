@extends('layouts.app_store')

@section('content')

	<div class="container b-item__line">
		<div class="b-item__title">
			<h1>{{ $product->title }} - {{ $product->category->title }} Record by <a href="#">{{ $product->name }}</a></h1>
		</div>
		<div class="row" style="margin-top: 15px;">
			<div class="col-sm-6 col-md-5 b-item-gallery">
				<div class="b-item-img">
					<img src="{{ asset('storage/images/' . $product->images->first()["title"]) }}" class="img-responsive" alt="no image for the item" id="largeImage">
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
						<form>
							<button type="button" class="btn btn-warning btn-addbtn">Add To Cart</button>
						</form>
					</div>
				</div>
				<div class="free-shipping">Free shipping</div>
			</div>
			<div class="col-sm-6 col-md-4 col-md-pull-3 b-item-param">
				<div class="b-param">
					<ul class="b-param__list">
						<li><span>Label:</span> Parlophone</li>
						<li><span>Genre:</span> Rock</li>
						<li><span>Description:</span> 180 Gram Vinyl 2 LP - Sealed </li>
						<li><span>Release Date</span>: 2016</li> 
						<li><span>UPC:</span> {{ $product->upc }}</li> 
						<li class="instock"><span>In Stock</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container b-description__line">
		<ul class="nav nav-tabs nav-justified">
			<li class="active"><a href="#tab-1" data-toggle="tab">Description</a></li>
			<li><a href="#tab-2" data-toggle="tab">Track Listing</a></li>
			<li><a href="#tab-3" data-toggle="tab">Video</a></li>
			<li><a href="#tab-4" data-toggle="tab">Reviews</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane b-description active" id="tab-1">
				<p>
					The Division Bell is the fourteenth studio album by the English progressive rock band Pink Floyd, released on 28 March 1994 by EMI Records in the United Kingdom and on 4 April by Columbia Records in the United States. The album's music was written mostly by guitarist and singer David Gilmour and keyboardist Rick Wright, and features Wright's first lead vocal on a Pink Floyd album since The Dark Side of the Moon (1973). Gilmour's fiancée, Polly Samson, co-wrote many of the lyrics, which deal with themes of communication. Recording took place in locations including the band's Britannia Row Studios, and Gilmour's houseboat, Astoria. The production team included Pink Floyd stalwarts such as producer Bob Ezrin, engineer Andy Jackson and saxophonist Dick Parry.
				</p>
			</div>
			<div class="tab-pane b-description" id="tab-2">
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
			<div class="tab-pane b-description" id="tab-4">Reviews</div>
		</div>
	</div>
	<div class="container b-also__line">
		<span class="h3">Customers who bought The Division Bell, also bought:</span>
		<div class="row" style="margin-top: 15px;">
			@foreach($items as $item)
				<div class="col-xs-6 col-sm-6 col-md-3">
					<div class="b-main__item center-block text-center">
						<div class="b-main-item-img center-block">
							<a href="{{ route('product.view', ['product' => $item->id]) }}"><img src="{{ asset('storage/images/' . $item->images->first()["title"]) }}"></a>
						</div>
						<a href="{{ route('product.view', ['product' => $item->id]) }}">
							<h5>{{ $item->name }}</h5>
							<h5>{{ $item->title }}</h5>
						</a>
						<p class="h4">${{ $item->price }}</p>
						<button type="button" class="btn btn-warning">Buy Now</button>
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