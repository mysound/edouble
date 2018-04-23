@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Ganres List @endslot
			@slot('parent') Main @endslot
			@slot('active') Ganres @endslot
		@endcomponent
		<hr>
		<a href="{{ route('admin.ganre.create') }}" class="btn btn-primary pull-right">Add Ganre</a>
		<table class="table table-striped">
			<thead>
				<th>Title</th>
				<th class="text-right">Action</th>
			</thead>
			<tbody>
				@forelse($ganres as $ganre)
					<tr>
						<td>{{ $ganre->title }}</td>
						<td class="text-right">
							<form method="POST" action="{{ route('admin.ganre.destroy', $ganre) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<a class="btn btn-default" href="{{ route('admin.ganre.edit', $ganre->id) }}"><i class="fa fa-edit"></i></a>
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
						<ul class="pagination pull-right">{{ $ganres->links() }}</ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection