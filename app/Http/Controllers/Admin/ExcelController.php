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
            $file = fopen(request()->file('importExcel'),"r");
            fgetcsv($file);
            while ($data = fgetcsv($file, 1000, ";")) {
                $product = \App\Product::updateOrCreate(
                    [
                        'sku' => $data[0]
                    ],
                    [
                        'sku' => $data[0],
                        'title' => $data[1],
                        'name' => $data[2],
                        'price' => $data[3],
                        'quantity' => $data[4],
                        'upc' => $data[5],
                        'category_id' => $data[6],
                        'slug' => ''
                    ]
                );
            }
    	}
    	return "ok upload Excel";
    }
}
