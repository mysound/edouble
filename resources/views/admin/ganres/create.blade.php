@extends('admin.layouts.app_admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Creating a ganre @endslot
			@slot('parent') Main @endslot
			@slot('active') Ganres @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.ganre.store') }}">
			{{ csrf_field() }}

			{{-- Form include --}}
			@include('admin.ganres.partials.form')
		</form>
	</div>
@endsection