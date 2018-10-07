<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Order;
use Cart;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
    	if (Auth::check()) {
    		dd('ok');
    	}
    	$address = new Address;
    	$address->user_id = '1';
    	$address->country_id = '1';
    	$address->first_name = $request->first_name;
    	$address->last_name = $request->last_name;
    	$address->address = $request->address;
    	$address->state = $request->state;
    	$address->city = $request->city;
    	$address->zip_code = $request->zip_code;
    	$address->phone = $request->phone;
    	$address->comment = $request->comment;
    	$address->save();

    	$order = new Order;
    	$order->user_id = '2';
    	$order->address_id = $address->id;
    	$order->save();

    	foreach (Cart::content() as $product) {
	    	$order->products()->attach($product->id, [
	    		'price' => $product->price,
	    		'quantity' => $product->qty
	    		]
	    	);
    	}

    	return "OK";
    }
}
