@extends('layouts.app_store')

@section('content')
	<div class="container b-item__line">
		<div class="b-item__title">
			<h1>Contact Us</h1>
		</div><br>
		<div>
			@if (count($errors))
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form method="POST" action="{{ route('send.contact') }}" class="form-horizontal">
				{{ csrf_field() }}
				<div class="form-group">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-8">
						<input type="email" name="from" class="form-control" placeholder="Email" required="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-8">
						<input type="text" name="name" class="form-control" placeholder="Name" required="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Text</label>
					<div class="col-sm-8">
						<textarea name="text" class="form-control" rows="3" required=""></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-8">
						{!! NoCaptcha::display() !!}
					</div>
				</div>	
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-success">Send</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection