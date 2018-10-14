@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Address</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-md-12">
                        <form method="POST" class="form-horizontal" action="{{ route('addresses.update', $address->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}                            
                            {{-- Form include --}}
                            @include('user.addresses.partials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection