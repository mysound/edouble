<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use App\Brand;
use App\Ganre;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->searchField. '%')
                                ->orwhere('title', 'LIKE', '%' . $request->searchField. '%')
                                ->orwhere('upc', $request->searchField)
                                ->paginate(10);
        $products->appends(['searchField' => $request->searchField]);

        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create', [
            'product'   => [],
            'categories' => Category::with('children')->where('parent_id', '0')->get(),
            'brands' => Brand::all(),
            'ganres' => Ganre::all(),
            'separator'  => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name'  =>  'required',
            'title' =>  'required',
            'price' =>  'required|numeric',
            'image.*' =>  'sometimes|image'
        ]);

        $product = Product::create($request->all());

        if(request()->hasFile('image')) {
            $files = request()->file('image');

            $product->addImage($files);
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product'   => $product,
            'categories' => Category::with('children')->where('parent_id', '0')->get(),
            'brands' => Brand::all(),
            'ganres' => Ganre::all(),
            'separator'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $this->validate(request(), [
            'name'  =>  'required',
            'title' =>  'required',
            'price' =>  'required|numeric',
            'image.*' =>  'sometimes|image'
        ]);

        $product->update($request->except('slug'));

        if(request()->hasFile('image')) {
            $product->deleteImage();
            
            $files = request()->file('image');

            $product->addImage($files);
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->images->isNotEmpty()) {
            $product->deleteImage();
        }
        
        $product->delete();

        return redirect()->route('admin.product.index');
    }
}
