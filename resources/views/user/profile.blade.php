@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Your Profile</div>
                <div class="panel-body">
                	<form method="POST" action="{{ route('user.update', Auth::user()->id) }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						
						<label for="">Name</label>
						<input class="form-control" type="text" name="name" placeholder="Address" value="{{ Auth::user()->name }}">
						
						<label for="">First Name</label>
						<input class="form-control" type="text" name="first_name" placeholder="First Name" value="{{ Auth::user()->first_name }}"	>
						
						<label for="">Last Name</label>
						<input class="form-control" type="text" name="last_name" placeholder="Last Name" value="{{ Auth::user()->last_name }}">
						<br>
						<a href="{{ route('home') }}" class="btn btn-info">Cancel</a>
						<input class="btn btn-success" type="submit" value="Update profile">
					</form>
				</div>
            </div>
        </div>
    </div>
</div>

@endsection