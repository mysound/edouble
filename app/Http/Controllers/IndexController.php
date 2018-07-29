<?php

namespace App\Http\Controllers;

use App\Ganre;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
    	return view('store.index', [
    		'ganres' => Ganre::all()
    	]);
    }
}
