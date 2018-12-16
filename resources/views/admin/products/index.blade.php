@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Product List @endslot
			@slot('parent') Main @endslot
			@slot('active') Products @endslot
		@endcomponent
		<hr>
		<div class="row">
			<div class="col-md-6">
				<form method="GET" action="{{ route('admin.product.search') }}" class="" role="search">
					{{ csrf_field() }}
					<div class="input-group">
						<input type="text" class="form-control" name="searchField" placeholder="Search" id="searchField">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
						</span>
					</div>
				</form>
			</div>
			<div class="col-md-3">
				<a href="{{ route('admin.upload.create') }}" class="btn btn-success pull-right"><i class="fa fa-upload"></i> ...Excel</a>
			</div>
			<div class="col-md-3">
				<a href="{{ route('admin.product.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Product</a>
			</div>
		</div>
		<table class="table table-striped">
			<thead>
				<th></th>
				<th>Name / Artist</th>
				<th>Title</th>
				<th>Qty</th>
				<th>Price</th>
				<th>Published</th>
				<th class="text-right">Action</th>
			</thead>
			<tbody>
				@forelse($products as $product)
					<tr>
						<td>
							@if($product->images->first()["title"] != "") 
								<img class="img" src="{{ asset('storage/images/thumbnails/' . $product->images->first()["title"]) }}" width="35"> 
							@endif
						</td>
						<td>{{ $product->name }}</td>
						<td>{{ $product->title }}</td>
						<td>{{ $product->quantity }}</td>
						<td>$ {{ $product->price }}</td>
						<td>{{ $product->published }}</td>
						<td class="text-right">
							<form method="POST" action="{{ route('admin.product.destroy', $product) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<a class="btn btn-default" href="{{ route('admin.product.edit', $product->id) }}"><i class="fa fa-edit"></i></a>
								<button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="7" class="text-center"><h2>Empty</h2></td>
					</tr>
				@endforelse
			</tbody>
			<tfoot>
				<tr>
					<td colspan="7">
						<ul class="pagination pull-right">{{ $products->links() }}</ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection