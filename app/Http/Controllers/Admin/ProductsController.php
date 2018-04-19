<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use App\Image;
use Intervention\Image\Facades\Image as ImageInt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

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
        $product = Product::create($request->all());

        if(request()->hasFile('image')) {
            $files = request()->file('image');

            foreach ($files as $file) {
                $image = time() . '.' . $file->getClientOriginalExtension();
                $picture = ImageInt::make($file)
                    ->resize(400, null, function ($constraint) { $constraint->aspectRatio(); } )
                    ->encode('jpg',100);
                Storage::disk('images')->put($image, $picture);
                $picture->destroy();
                $product->images()->create([
                    'title' => $image
                ]);
            }
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
        $product->update($request->except('slug'));

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
        $product->delete();

        return redirect()->route('admin.product.index');
    }
}
