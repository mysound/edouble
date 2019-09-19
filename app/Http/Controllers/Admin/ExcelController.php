<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Exports\ItemsExport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Storage;

class ExcelController extends Controller
{
    public function create()
    {
    	return view('admin.upload.create');
    }

    public function export(Request $request)
    {
        if($request->year and $request->month) {
            return (new ItemsExport($request->skuTitle, $request->year, $request->month))->download('Items.xlsx');
        } else {
            /*$skuTitle = 'Products';
            if ($request->skuTitle) {
                $skuTitle = $request->skuTitle;
            }
            (new ProductsExport($request->skuTitle, $request->year, $request->month))->queue($skuTitle.'.xlsx', 'files');*/
            
            return back()->withSuccess('Export started!');
        }
    }

    public function download(Request $request)
    {
        return response()->download('storage/files/'.$request->fileTitle.'.xlsx', $request->fileTitle.'.xlsx');
    }

    public function import(Request $request)
    {
        ini_set('max_execution_time', 300);
        
        Excel::queueImport(new ProductsImport($request->skutitle), $request->file('importExcel'));

        return redirect('/admin/product')->with('success', 'All good!');
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
                        'name' => ucwords(strtolower($data[1])),
                        'title' => ucwords(strtolower($data[2])),
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
