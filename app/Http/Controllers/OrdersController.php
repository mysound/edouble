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
            $shipping_address = $this->shippingAddress($address_id);

            $order = $this->newOrder($user_id, $address_id, $shipping_address);

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
            
            $shipping_address = $this->shippingAddress($address->id);

            $order = $this->newOrder($user->id, $address->id, $shipping_address);
        }

        return redirect()->route('order.checkout', $order)->with('message', 'Your Order Was Created');
    }

    public function newOrder($user_id, $address_id, $shipping_address)
    {
        $order = new Order;
        $order->user_id = $user_id;
        $order->address_id = $address_id;
        $order->comment = '';
        $order->shipping_address = $shipping_address;
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

    public function shippingAddress($id)
    {
        $address = Address::find($id);
        $shipping_address = $address->last_name.' '.$address->first_name.', '.$address->address.', '.$address->city.', '.$address->state.', '.$address->zip_code.', '.$address->country_id.', '.$address->phone;

        return $shipping_address;
    }

    public function checkoutPage(Order $order)
    {
        $order = Auth::user()->orders()->find($order->id);
        
        return view('order.checkout', [
            'order' => $order,
            'products' => $order->products()->get()
        ]);
    }
}
