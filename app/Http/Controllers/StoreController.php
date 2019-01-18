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
    		'products' => Product::paginate(12)
    	]);
    }

    public function ganreSearch($id)
    {
        $ganre_id = $id;
        return view('store.search', [
            'products' => Product::where('ganre_id', '=', $ganre_id)->paginate(12),
            'ganre_id' => $ganre_id,
            'category_id' => '',
            'searchField' => '',
            'min_price' => '',
            'max_price' => ''
        ]);
    }

    public function search(Request $request) 
    {
        $min_price = $request->min_price ? $request->min_price : 0;
        $max_price = $request->max_price ? $request->max_price : 100000;
        
        if ($request->has('category_id')) {
            if ($request->has('ganre_id')) {
                $products = Product::where([
                                        ['category_id', '=', $request->category_id],
                                        ['ganre_id', '=', $request->ganre_id]
                                    ])
                                        ->whereBetween('price', [$min_price, $max_price])
                                        ->paginate(12);
            } else {
                $products = Product::where([
                                            ['name', 'LIKE', '%' . $request->searchField. '%'],
                                            ['category_id', '=', $request->category_id]
                                        ])
                                        ->whereBetween('price', [$min_price, $max_price])
                                        ->orwhere([
                                            ['title', 'LIKE', '%' . $request->searchField. '%'],
                                            ['category_id', '=', $request->category_id]
                                        ])
                                        ->whereBetween('price', [$min_price, $max_price])
                                        ->paginate(12);
            }
        }
        else {
            if ($request->has('ganre_id')) {
                $products = Product::where('ganre_id', '=', $request->ganre_id)
                                        ->whereBetween('price', [$min_price, $max_price])
                                        ->paginate(12);
            } else {
                $products = Product::where('name', 'LIKE', '%' .$request->searchField. '%')
                                        ->whereBetween('price', [$min_price, $max_price])
                                        ->orwhere('title', 'LIKE', '%' .$request->searchField. '%')
                                        ->whereBetween('price', [$min_price, $max_price])
                                        ->paginate(12);
            }
        }

        $products->appends([
                            'searchField' => $request->searchField,
                            'category_id' => $request->category_id,
                            'ganre_id' => $request->ganre_id,
                            'min_price' => $request->min_price,
                            'max_price' => $request->max_price
                        ]);

    	return view('store.search', [
    		'products' => $products,
            'ganre_id' => $request->ganre_id,
            'category_id' => $request->category_id,
            'searchField' => $request->searchField,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price
    	]);
    }

    public function about()
    {
        return view('store.about');
    }

    public function policy()
    {
        return view('store.policy');
    }

    public function shipping()
    {
        return view('store.shipping');
    }

    public function faq()
    {
        return view('store.faq');
    }
}
