@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Youre Addresses</div>

                <div class="panel-body">
                	
                    
                    <div class="col-md-8 col-md-offset-2">
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <a href="{{ route('home') }}" class="btn btn-info">Beck</a>
                    		<a href="{{ route('addresses.create') }}" class="btn btn-success pull-right">Add New Address</a>
                        </div>
                    	@foreach(Auth::user()->addresses as $address)
    	                	<div class="col-md-10">
    	                		<p>
    	                			{{ $address->first_name.' '.$address->last_name }},<br>
    	                			{{ $address->address }},
    	                			{{ $address->city.', '.$address->state->code }},
    	                			{{ $address->zip_code }}, {{ $address->country->name }},<br>
    	                			Phone: {{ $address->phone }}
    	                		</p>
    	                	</div>
                            <div class="col-md-2" style="margin-bottom: 10px;">
                                <form method="POST" action="{{ route('addresses.destroy', $address->id) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a class="btn btn-default" href="{{ route('addresses.edit', $address->id) }}"><i class="fa fa-edit"></i></a>
                                <button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </div>
                    	@endforeach
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
