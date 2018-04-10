@extends('admin.layouts.app_admin')

@section('content')
	<div class="container">
		@component('admin.components.breadcrumb')
			@slot('title') Category List @endslot
			@slot('parent') Main @endslot
			@slot('active') Categories @endslot
		@endcomponent
		<hr>
		<a href="{{ route('admin.category.create') }}" class="btn btn-primary pull-right">Add Category</a>
		<table class="table table-striped">
			<thead>
				<th>Title</th>
				<th>Published</th>
				<th class="text-right">Action</th>
			</thead>
			<tbody>
				@forelse($categories as $category)
					<tr>
						<td>{{ $category->title }}</td>
						<td>{{ $category->published }}</td>
						<td class="text-right">
							<form method="POST" action="{{ route('admin.category.destroy', $category) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<a class="btn btn-default" href="{{ route('admin.category.edit', $category->id) }}"><i class="fa fa-edit"></i></a>
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
						<ul class="pagination pull-right">{{ $categories->links() }}</ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection