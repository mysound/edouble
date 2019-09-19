<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Order;
use App\Transaction;
use App\Mail\TrackingNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Storage;
use DateTime;

class DashboardController extends Controller
{
    //Dashboard
    public function dashboard() 
    {
        $jobs = false;
        DB::select('select * from jobs') ? $jobs = true : $jobs = false;

        $allProducts = $this->exelfileExists('products.xlsx');
        $redeye = $this->exelfileExists('REDEYE.xlsx');
        $secretly = $this->exelfileExists('SECRETLY.xlsx');
    	return view('admin.dashboard', [
    		'countpro' => Product::all()->count(),
    		'countord' => Order::all()->count(),
            'allProducts' => $allProducts,
            'redeye' => $redeye,
            'secretly' => $secretly,
            'jobs' => $jobs,
            'countsales' => Transaction::where('sale_status', 'completed')->count()
    	]);
    }

    public function exelfileExists($title)
    {
        $lastmodified = false;
        if(Storage::disk('files')->exists($title)) {
            $time = Storage::disk('files')->lastModified($title);
            $lastmodified = DateTime::createFromFormat("U", $time);
            $lastmodified = $lastmodified->format('Y-m-d H:i:s');
        }
        return $lastmodified;
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

        Mail::to($order->user->email)->send(new TrackingNumber($order));

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
