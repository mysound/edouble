@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Edit a brand @endslot
			@slot('parent') Main @endslot
			@slot('active') Brands @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.brand.update', $brand) }}">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			{{-- Form include --}}
			@include('admin.brands.partials.form')
		</form>
	</div>
@endsection