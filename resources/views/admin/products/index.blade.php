@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Product List @endslot
			@slot('parent') Main @endslot
			@slot('active') Products @endslot
		@endcomponent
		<hr>
		<a href="{{ route('admin.upload.create') }}" class="btn btn-success"><i class="fa fa-upload"></i> ...Excel</a>
		<a href="{{ route('admin.product.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Product</a>
		<table class="table table-striped">
			<thead>
				<th></th>
				<th>Name / Artist</th>
				<th>Title</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Published</th>
				<th class="text-right">Action</th>
			</thead>
			<tbody>
				@forelse($products as $product)
					<tr>
						<td>
							@if($product->images->first()["title"] != "") 
								<img class="img" src="{{ asset('storage/images/' . $product->images->first()["title"]) }}" width="35"> 
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