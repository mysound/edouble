@extends('admin.layouts.app_admin')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Order #{{ $order->id }}</div>
                <div class="panel-body">
                    <form method="POST" class="form-horizontal" action="{{ route('admin.tracking.store') }}" enctype="multipart/form-data">
						{{ csrf_field() }}

						@include('admin.orders.partials.form')
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection