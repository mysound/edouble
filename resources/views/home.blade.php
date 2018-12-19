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
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Shiiping status</th>
                                <th>Status Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr class="@if($order->transactions->first()['sale_status'] == 'completed') success @endif">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>${{ $order->total }}</td>
                                <td>{{ $order->shipping_no ? 'Shipped' : '-' }}</td>
                                <td>
                                    @if($order->transactions->first()['sale_status'])
                                       <a href="{{ route('order.details', $order->id) }}">{{ $order->transactions->first()['sale_status'] }}</a>
                                    @else
                                        <a href="{{ route('order.checkout', $order->id) }}">Pay Now</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <ul class="pagination pull-right">{{ $orders->links() }}</ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
