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

    public function shope()
    {
    	return view('store.search', [
    		'products' => Product::paginate(9)
    	]);
    }

    public function ganreSearch($id)
    {
        $ganre_id = $id;
        return view('store.search', [
            'products' => Product::where('ganre_id', '=', $ganre_id)->paginate(9)
        ]);
    }

    public function search(Request $request) 
    {
    	return view('store.search', [
    		'products' => Product::where('name', 'LIKE', '%' . $request->searchField. '%')
                                    ->orwhere('title', 'LIKE', '%' . $request->searchField. '%')
                                    ->paginate(9)
    	]);
    }
}
