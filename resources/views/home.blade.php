@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-md-8 col-md-offset-2">
                        
                    <div class="col-md-8">
                        <h4>Your Profile: {{ Auth::user()->name }}</h4>
                        <p>{{ Auth::user()->email }}</p>
                        <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </p>
                        <p><small><a href="{{ route('user.edit', Auth::user()->id) }}">edit</a></small></p>
                    </div>
                    <div class="col-md-4">
                        <h4>Addresses - {{ Auth::user()->addresses->count() }}</h4>
                        {{-- <a href="{{ route('user.addresses', Auth::user()->id) }}">View All Addresses</a> --}}
                        <a href="{{ route('addresses.index') }}">View All Addresses</a>
                    </div>
                    </div>
                </div>
                 

                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Orders - {{ Auth::user()->orders->count() }}</div>
                <div class="panel-body"></div>
            </div>
        </div>
    </div>
</div>
@endsection
