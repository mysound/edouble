@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Brands List @endslot
			@slot('parent') Main @endslot
			@slot('active') Brands @endslot
		@endcomponent
		<hr>
		<a href="{{ route('admin.brand.create') }}" class="btn btn-primary pull-right">Add Brand</a>
		<table class="table table-striped">
			<thead>
				<th>Title</th>
				<th class="text-right">Action</th>
			</thead>
			<tbody>
				@forelse($brands as $brand)
					<tr>
						<td>{{ $brand->title }}</td>
						<td class="text-right">
							<form method="POST" action="{{ route('admin.brand.destroy', $brand) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<a class="btn btn-default" href="{{ route('admin.brand.edit', $brand->id) }}"><i class="fa fa-edit"></i></a>
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
						<ul class="pagination pull-right">{{ $brands->links() }}</ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection