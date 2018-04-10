@extends('admin.layouts.app_admin')

@section('content')
	<div class="container">
		@component('admin.components.breadcrumb')
			@slot('title') Edit a category @endslot
			@slot('parent') Main @endslot
			@slot('active') Categories @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.category.update', $category) }}">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			{{-- Form include --}}
			@include('admin.categories.partials.form')
		</form>
	</div>
@endsection