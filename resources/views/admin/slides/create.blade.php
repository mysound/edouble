@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Creating a slide @endslot
			@slot('parent') Main @endslot
			@slot('active') Slides @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.slide.store') }}" enctype="multipart/form-data">
			{{ csrf_field() }}

			{{-- Form include --}}
			@include('admin.slides.partials.form')
		</form>
	</div>
@endsection