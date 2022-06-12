<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Favourite;
use App\Models\Product_media;
use App\Models\Product_variance;
use App\Models\subcategory;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all products in pagination
        $products = Product::paginate(15);
        foreach ($products as $product) {
            $product->variance = Product_variance::where('product_id', $product->id)->get();
            $product->media = Product_media::where('product_id', $product->id)->get();
            $product->price = Product_variance::where('product_id', $product->id)->first()->price;
            $product->quantity = Product_variance::where('product_id', $product->id)->first()->quantity;
            $product->image = Product_media::where('product_id', $product->id)->first()->media_url;
            $product->category = subcategory::where('id', $product->subcategory_id)->get('name');
        }
        

        return view('welcome', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create a new product
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // store a new product
        $product = new Product;
        $product->insert($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // show a product
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // edit a product
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // update a product
        $product->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // delete a product
        $product->delete();
    }
  
}
