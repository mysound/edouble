<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Address;
use App\User;
use Cart;
use App\Mail\NewOrder;
use App\Mail\NewUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
                'state_id'  =>  'required|not_in:0',
                'zip_code'  =>  'required',
                'phone'  =>  'required',
                'g-recaptcha-response' => 'required|captcha'
            ]);

            $random_pas = str_random(6);
            $user = new User;
            $user->name = $request->first_name;
            $user->email = $request->email;
            $user->password = bcrypt($random_pas);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;            
            $user->save();

            Mail::to($user->email)->send(new NewUser($user, $random_pas));

            $address = $user->addresses()->create([
                'country_id' => $request->country_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'state_id' => $request->state_id,
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
        $tax = 0;
        $address = Address::find($address_id);
        if ($address->state->code == 'NY') {
            $tax = number_format(Cart::subtotal()*8.875/100, 2, '.', '');
        }

        $total = Cart::subtotal() + $tax;

        $order = new Order;
        $order->user_id = $user_id;
        $order->address_id = $address_id;
        $order->comment = '';
        $order->shipping_address = '';
        $order->total = $total;
        $order->subtotal = Cart::subtotal();
        $order->total_tax = $tax;
        $order->save();

        foreach (Cart::content() as $product) {
            $order->products()->attach($product->id, [
                'price' => $product->price,
                'quantity' => $product->qty
                ]
            );
        }
        Cart::destroy();

        Mail::to(User::first())->send(new NewOrder($order));

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
