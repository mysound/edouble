<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Order;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //Dashboard
    public function dashboard() 
    {
    	return view('admin.dashboard', [
    		'countpro' => Product::all()->count(),
    		'countord' => Order::all()->count(),
            'countsales' => Transaction::where('sale_status', 'completed')->count()
    	]);
    }

    public function orders() 
    {
    	return view('admin.orders.index', [
    		'orders' => Order::orderBy('created_at', 'desc')->paginate(20)
    	]);
    }

    public function addTracking($order)
    {
        return view('admin.orders.addtracking', [
            'order' => Order::find($order)
        ]);
    }

    public function storeTracking(Request $request)
    {
        $this->validate(request(), [
            'shipping_no'  =>  'required'
        ]);

        $order = Order::find($request->order_id);
        $order->shipping_no = $request->shipping_no;
        $order->save();

        return redirect()->route('admin.order.index');
    }

    public function orderDetails(Order $order)
    {
        $products = $order->products;
        $quantity = 0;

        foreach ($products as $product) {
            $quantity = $quantity + $product->pivot->quantity;
        }

        return view('admin.orders.details', [
            'order' => $order,
            'products' => $order->products()->get(),
            'quantity' => $quantity
        ]);
    }

    public function editTracking($order)
    {
        return view('admin.orders.edittracking', [
            'order' => Order::find($order)
        ]);
    }

    public function updateTracking(Request $request, Order $order)
    {
        $this->validate(request(), [
            'shipping_no'  =>  'required'
        ]);

        $order->shipping_no = $request->shipping_no;
        $order->save();

        return redirect()->route('admin.order.index');
    }
}
