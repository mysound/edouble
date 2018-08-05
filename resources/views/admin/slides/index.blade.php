@extends('admin.layouts.app_admin')
@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Slider List @endslot
			@slot('parent') Main @endslot
			@slot('active') Slider @endslot
		@endcomponent
		<hr>
		<a href="{{ route('admin.slide.create') }}" class="btn btn-primary pull-right">Add Slide</a>
		<table class="table table-striped">
			<thead>
				<th>Title</th>
				<th>Image</th>
				<th>Product ID</th>
				<th class="text-right">Action</th>
			</thead>
			<tbody>
				@forelse($slides as $slide)
					<tr>
						<td>{{ $slide->title }}</td>
						<td>
							@if($slide->images->first()["title"] != "") 
								<img class="img" src="{{ asset('storage/images/' . $slide->images->first()["title"]) }}" width="75"> 
							@endif						
						</td>
						<td>{{ $slide->product_id }}</td>
						<td class="text-right">
							<form method="POST" action="{{ route('admin.slide.destroy', $slide) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<a class="btn btn-default" href="{{ route('admin.slide.edit', $slide->id) }}"><i class="fa fa-edit"></i></a>
								<button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="4" class="text-center"><h2>Empty</h2></td>
					</tr>
				@endforelse
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">
						<ul class="pagination pull-right"></ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection