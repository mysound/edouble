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
				<span class="btn btn-block btn-default">Downloads</span>
				<span class="list-group-item">
					<h4 class="list-group-item-heading">All Items</h4>
					<p class="list-group-item-text">
						Amount Items ({{ $countpro }})
						<span>@if($allProducts)<a href="{{ route('admin.download', ['fileTitle' => 'Products']) }}">{{ $allProducts }} <i class="fa fa-download"></i></a>@endif</span>
						<a href="{{ route('admin.export', ['skuTitle' => '']) }}" class="pull-right"><i class="fa fa-refresh"></i></a>
					</p>
				</span>
				<span class="list-group-item">
					<h4 class="list-group-item-heading">Redeye</h4>
					<p class="list-group-item-text">
						Amount Items
					</p>
				</span>
				<span class="list-group-item">
					<h4 class="list-group-item-heading">Secretly</h4>
					<p class="list-group-item-text">
						Amount Items
					</p>
				</span>
			</div>
			<div class="col-sm-6">
				<span class="btn btn-block btn-default">Sales</span>
				<span class="list-group-item">
					<h4 class="list-group-item-heading">All Items</h4>
					<p class="list-group-item-text">
						Amount Items
					</p>
				</span>
				<span class="list-group-item">
					<h4 class="list-group-item-heading">Redeye</h4>
					<p class="list-group-item-text">
						Amount Items
					</p>
				</span>
				<span class="list-group-item">
					<h4 class="list-group-item-heading">Secretly</h4>
					<p class="list-group-item-text">
						Amount Items
					</p>
				</span>
			</div>
		</div>
	</div>
@endsection