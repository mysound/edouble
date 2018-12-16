@extends('admin.layouts.app_admin')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">All orders</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Tracking</th>
                                <th>Total</th>
                                <th>Status Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at }}</td>
                                @if($order->shipping_no == null)
                                    <td class="danger"><a href="{{ route('admin.addtracking', $order->id) }}">Add tracking</a></td>
                                @else
                                    <td><a href="{{ route('admin.tracking.edit', $order->id) }}">{{ $order->shipping_no }}</a></td>
                                @endif
                                <td>${{ $order->total }}</td>
                                @if($order->transactions->first()['sale_status'] == 'completed')
                                   <td class="success"><a href="{{ route('admin.order.details', $order->id) }}">{{ $order->transactions->first()['sale_status'] }}</a></td>
                                @else
                                    <td>Awaiting payment</td>
                                @endif
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