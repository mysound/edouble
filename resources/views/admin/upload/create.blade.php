@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Uploading a Excel file @endslot
			@slot('parent') Main @endslot
			@slot('active') Upload @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.upload.store') }}" enctype="multipart/form-data">
			{{ csrf_field() }}

			<input class="form-control" type="file" name="importExcel" id="importExcel">
			<hr>
			<input class="btn btn-primary" type="submit" value="Upload">
			<hr>
		</form>
	</div>
@endsection