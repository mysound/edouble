@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Creating a category @endslot
			@slot('parent') Main @endslot
			@slot('active') Categories @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.category.store') }}">
			{{ csrf_field() }}

			{{-- Form include --}}
			@include('admin.categories.partials.form')
		</form>
	</div>
@endsection