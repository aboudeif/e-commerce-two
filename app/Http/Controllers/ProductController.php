<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Favourite;
use App\Models\Product_media;
use App\Models\Product_variance;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $request = request();
        $user_id = (Auth::check()) ? auth()->user()->id : 0;

        $products = Product::with('product_variances:id,product_id,price','product_media:id,product_id,media_url',
                                  'Subcategory.Category:id,name','favourites:user_id,product_id')
        ->when($request->has('keyword'), function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->keyword . '%');
        })

        ->when($request->has('category'), function ($query) use ($request) {
            return $query->whereHas('Subcategory', function ($query) use ($request) {
                return $query->where('category_id', $request->category);
            });
        })
        ->when($request->has('subcategory'), function ($query) use ($request) {
            return $query->whereHas('Subcategory', function ($query) use ($request) {
                return $query->where('name', $request->subcategory);
            });
        })
        ->when($request->has('category') && $request->has('subcategory'), function ($query) use ($request) {
            return $query->where('subcategory_id', $request->subcategory);
        })

        ->whereHas('product_variances')
        ->whereHas('product_media')
    
        ->paginate(15);
        //dd($products[0]);
       
        return view('welcome', compact('products', 'request'));
 
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
        // delete a product from products table
        $product->delete();

    }
  
}
