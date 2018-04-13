@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Creating a product @endslot
			@slot('parent') Main @endslot
			@slot('active') Products @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.product.store') }}">
			{{ csrf_field() }}

			{{-- Form include --}}
			@include('admin.products.partials.form')
			<input type="hidden" name="created_by" value="{{ Auth::id() }}">
		</form>
	</div>
@endsection