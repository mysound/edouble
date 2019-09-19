@extends('admin.layouts.app_admin')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Categories 0</span></p>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><a href="{{ route('admin.product.index') }}"><span class="label label-primary">Products {{ $countpro }}</span></a></p>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Sales {{ $countsales }}</span></p>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><a href="{{ route('admin.order.index') }}"><span class="label label-primary">Orders {{ $countord }}</span></a></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<span class="btn btn-block btn-default">Vendors</span>
				{{-- <span class="list-group-item">
					<h4 class="list-group-item-heading">All Items 2019 Year</h4>
					<p class="list-group-item-text">
						Amount Items ({{ $countpro }})
						<span>@if($allProducts)<a href="{{ route('admin.download', ['fileTitle' => 'Products']) }}">{{ $allProducts }} <i class="fa fa-download"></i></a>@endif</span>
						@if(!$jobs)<a href="{{ route('admin.export', ['skuTitle' => '']) }}" class="pull-right"><i class="fa fa-refresh"></i></a>@endif
					</p>
				</span>
				<span class="list-group-item">
					<h4 class="list-group-item-heading">Redeye 2019 Year</h4>
					<p class="list-group-item-text">
						Amount Items
						<span>@if($redeye)<a href="{{ route('admin.download', ['fileTitle' => 'REDEYE']) }}">{{ $redeye }} <i class="fa fa-download"></i></a>@endif</span>
						@if(!$jobs)<a href="{{ route('admin.export', ['skuTitle' => 'REDEYE']) }}" class="pull-right"><i class="fa fa-refresh"></i></a>@endif
					</p>
				</span>
				<span class="list-group-item">
					<h4 class="list-group-item-heading">Secretly 2019 Year</h4>
					<p class="list-group-item-text">
						Amount Items
						<span>@if($secretly)<a href="{{ route('admin.download', ['fileTitle' => 'SECRETLY']) }}">{{ $secretly }} <i class="fa fa-download"></i></a>@endif</span>
						@if(!$jobs)<a href="{{ route('admin.export', ['skuTitle' => 'SECRETLY']) }}" class="pull-right"><i class="fa fa-refresh"></i></a>@endif
					</p>
				</span> --}}
				<span class="list-group-item">
					<h4 class="list-group-item-heading">Nullify Quantity</h4>
					<form class="form-inline" method="POST" action="{{ route('admin.nullify') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<select class="form-control" name="catTitle">
								<option disabled>-- Select Catalog --</option>
								<option value="SECRETLY">SECRETLY</option>
								<option value="REDEYE">REDEYE</option>
							</select>
						</div>
						<button class="btn btn-primary" type="submit">Change Quantity</button>
					</form>
				</span>
			</div>
			<div class="col-sm-6">
				<span class="btn btn-block btn-default">Reports</span>
				<span class="list-group-item">
					<form method="GET" action="{{ route('admin.export') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="sr-only" for="year">Year</label>
							<input type="text" class="form-control" name="year" id="year" placeholder="Year" required="">
						</div>
						<div class="form-group">
							<label class="sr-only" for="month">Month</label>
							<input type="text" class="form-control" name="month" id="month" placeholder="Month" required="">
						</div>
						<div class="form-group">
							<select class="form-control" name="skuTitle">
								<option value="">-- All Vendors --</option>
								<option value="REDEYE">REDEYE</option>
								<option value="SECRETLY">SECRETLY</option>
							</select>
						</div>
						<hr>
						<input class="btn btn-primary" type="submit" value="Download For eBay">
						<hr>
					</form>
				</span>
			</div>
		</div>
	</div>
@endsection