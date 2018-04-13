@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Edit a product @endslot
			@slot('parent') Main @endslot
			@slot('active') Products @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.product.update', $product) }}">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			{{-- Form include --}}
			@include('admin.products.partials.form')
			<input type="hidden" name="modified_by" value="{{ Auth::id() }}">
		</form>
	</div>
@endsection