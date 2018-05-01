@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Creating a brand @endslot
			@slot('parent') Main @endslot
			@slot('active') Brands @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.brand.store') }}">
			{{ csrf_field() }}

			{{-- Form include --}}
			@include('admin.brands.partials.form')
		</form>
	</div>
@endsection