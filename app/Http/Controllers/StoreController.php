<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function itemView(Product $product)
    {
    	return view('store.products.view', compact('product'), [
    		'items' => Product::all()->random(4)
    	]);
    }
}
