<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

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
        
        return $products;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
