<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //Dashboard
    public function dashboard() {
    	return view('admin.dashboard', [
    		'countpro' => Product::all()->count()
    	]);
    }
}
