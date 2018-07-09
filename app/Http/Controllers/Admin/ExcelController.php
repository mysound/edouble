<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use DB;

class ExcelController extends Controller
{
    public function create()
    {
    	return view('admin.upload.create');
    }

    public function importExcel()
    {	
    	if(request()->hasFile('importExcel')) {
            /*$file = request()->file('importExcel');*/
            $file = fopen(request()->file('importExcel'),"r");
            fgetcsv($file);
            while ($data = fgetcsv($file, 1000, ";")) {
                /*$product = DB::table('products')->insert([
                    'category_id' => $data[0],
                    'title' => $data[1],
                    'name' => $data[2],
                    'price' => $data[3],
                    'slug' => $data[0].'slug'
                ]);*/
                $product = \App\Product::create([
                    'category_id' => $data[0],
                    'title' => $data[1],
                    'name' => $data[2],
                    'price' => $data[3],
                    'slug' => $data[0].'slug'
                ]);
            }
    		//dd(fgetcsv($file));
    	}
    	return "ok upload Excel";
    }
}
