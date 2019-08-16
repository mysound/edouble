<?php

namespace App\Http\Controllers;

use App\Ganre;
use App\Product;
use App\Slide;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
    	return view('store.index', [
    		'lps' => Product::has('images')->where('category_id', '2')->orderBy('created_at', 'desc')->take(12)->get(),
    		'discs' => Product::has('images')->where('category_id', '3')->take(4)->get(),
    		'slides' => Slide::all()
    	]);
    }
}
