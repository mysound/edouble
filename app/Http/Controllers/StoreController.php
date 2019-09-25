<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class StoreController extends Controller
{
    public function itemView(Product $product)
    {
        $preorder = $this->preorderNow($product->release_date);
    	return view('store.products.view', compact('product'), [
    		'items' => Product::all()->random(4),
            'preorder' => $preorder
    	]);
    }

    public function shope()
    {
    	return view('store.search', [
    		'products' => Product::paginate(12)
    	]);
    }

    public function preorder()
    {
        return redirect()->route('store.search', ['preorder' => true]);
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
            'max_price' => '',
            'preorder' => ''
        ]);
    }

    public function search(Request $request) 
    {
        $date = Carbon::now()->format('Y-m-d');

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
                if ($request->preorder) {
                    $products = Product::where('release_date', '>', $date)
                                            ->paginate(12);

                } else {
                    $products = Product::where('name', 'LIKE', '%' .$request->searchField. '%')
                                            ->whereBetween('price', [$min_price, $max_price])
                                            ->orwhere('title', 'LIKE', '%' .$request->searchField. '%')
                                            ->whereBetween('price', [$min_price, $max_price])
                                            ->paginate(12);
                }
            }
        }

        $products->appends([
                            'searchField' => $request->searchField,
                            'category_id' => $request->category_id,
                            'ganre_id' => $request->ganre_id,
                            'min_price' => $request->min_price,
                            'max_price' => $request->max_price,
                            'preorder' => $request->preorder
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
    
    public function contact()
    {
        return view('store.contact');
    }

    public function contactSend(Request $request)
    {
        $this->validate(request(), [
            'from' => 'required|email',
            'name' => 'required|min:2',
            'text' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $from = $request->from;
        $name = $request->name;
        $text = $request->text;

        Mail::to(User::first())->send(new ContactUs($from, $name, $text));

        return redirect()->route('shop')->with('message', 'Your Message Was send');
    }

    public function preorderNow($date)
    {
        $dateNow = Carbon::now()->format('Y-m-d');
        if($dateNow <= $date) {
            return true;
        } else {
            return false;
        }
    }
}
