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
				<a href="{{ route('admin.category.create') }}" class="btn btn-block btn-default">Add New Category</a>
				<a href="#" class="list-group-item">
					<h4 class="list-group-item-heading">Last Category</h4>
					<p class="list-group-item-text">
						Amount Items
					</p>
				</a>
			</div>
			<div class="col-sm-6">
				<a href="{{ route('admin.product.create') }}" class="btn btn-block btn-default">Add New Item</a>
				<a href="#" class="list-group-item">
					<h4 class="list-group-item-heading">Last Item</h4>
					<p class="list-group-item-text">
						Category
					</p>
				</a>
			</div>
		</div>
	</div>
@endsection