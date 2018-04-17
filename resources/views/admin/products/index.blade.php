@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Product List @endslot
			@slot('parent') Main @endslot
			@slot('active') Products @endslot
		@endcomponent
		<hr>
		<a href="{{ route('admin.product.create') }}" class="btn btn-primary pull-right">Add Product</a>
		<table class="table table-striped">
			<thead>
				<th>Title</th>
				<th>Published</th>
				<th class="text-right">Action</th>
			</thead>
			<tbody>
				@forelse($products as $product)
					<tr>
						<td>{{ $product->title }}</td>
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
						<td colspan="3" class="text-center"><h2>Empty</h2></td>
					</tr>
				@endforelse
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">
						<ul class="pagination pull-right">{{ $products->links() }}</ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection