<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Address;
use App\User;
use Cart;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::user()) {
            $user_id = Auth::id();
            $address_id = $request->address;

            $order = $this->newOrder($user_id, $address_id);

        } else {

            $this->validate(request(), [
                'first_name'  =>  'required',
                'last_name'  =>  'required',
                'email' => 'required|unique:users',
                'address'  =>  'required',
                'city'  =>  'required',
                'state'  =>  'required',
                'zip_code'  =>  'required',
                'phone'  =>  'required'
            ]);

            $user = new User;
            $user->name = $request->first_name;
            $user->email = $request->email;
            $user->password = bcrypt('password');
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;            
            $user->save();

            $address = $user->addresses()->create([
                'country_id' => $request->country_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'state' => $request->state,
                'city' => $request->city,
                'zip_code' => $request->zip_code,
                'phone' => $request->phone
            ]);

            Auth::login($user);

            $order = $this->newOrder($user->id, $address->id);
        }

        return redirect()->route('order.checkout', $order)->with('message', 'Your Order Was Created');
    }

    public function newOrder($user_id, $address_id)
    {
        $order = new Order;
        $order->user_id = $user_id;
        $order->address_id = $address_id;
        $order->comment = '';
        $order->shipping_address = '';
        $order->total = Cart::subtotal();
        $order->save();

        foreach (Cart::content() as $product) {
            $order->products()->attach($product->id, [
                'price' => $product->price,
                'quantity' => $product->qty
                ]
            );
        }
        Cart::destroy();

        return $order;
    }

    public function checkoutPage(Order $order)
    {
        $order = Auth::user()->orders()->find($order->id);
        $products = $order->products;
        $quantity = 0;

        foreach ($products as $product) {
            $quantity = $quantity + $product->pivot->quantity;
        }
        return view('order.checkout', [
            'order' => $order,
            'products' => $order->products()->get(),
            'quantity' => $quantity
        ]);
    }

    public function orderDetails(Order $order)
    {
        $order = Auth::user()->orders()->find($order->id);
        $products = $order->products;
        $quantity = 0;

        foreach ($products as $product) {
            $quantity = $quantity + $product->pivot->quantity;
        }

        return view('order.details', [
            'order' => $order,
            'products' => $order->products()->get(),
            'quantity' => $quantity
        ]);
    }
}
