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
        
        $request = request();
        $subcategory = ProductController::getSubcategories($request);
        $keyword = $request->keyword;
      
            $products = Product::when($keyword, function ($query) use ($keyword) {
                $query->where('products.name', 'like', "%$keyword%");
            })->whereIn('products.subcategory_id', $subcategory)
              ->where('products.is_deleted', false)
              ->join('product_variances', 'product_variances.product_id', '=', 'products.id')
              ->where('product_variances.quantity', '>', 0)
              ->join('product_media', 'product_media.product_id', '=', 'products.id')
              ->where('product_media.media_url', '!=', null)
              ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
              ->join('categories', 'categories.id', '=', 'subcategories.category_id')
              ->select('products.*', 'product_variances.*', 'product_media.media_url', 'subcategories.name as subcategory', 'categories.name as category')
              ->paginate(15);
        
        return view('welcome', ['products' => $products]);
        }

      /**
     * Helper function to get Subcategories.
     */
    public function getSubcategories($request){
        $category = $request->category;
        $subcategory = $request->subcategory;
        if($category !== null){
            $category_id = Category::where('name', $category)->get()->id;
            $subcategories = Subcategory::where('category_id', $category_id)->get()->toArray();
        }
        else if($subcategory !== null){
            $subcategory_id = Subcategory::where('name', $subcategory)->get()->id;
            $subcategories = $subcategory_id->toArray();
        }
        else{
            $subcategories = Subcategory::all()->pluck('id')->toArray();
        }
        return $subcategories;
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
