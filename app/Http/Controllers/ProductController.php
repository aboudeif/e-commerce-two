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
        // get all products in pagination

        // filter products by keword and category and subcategory
        // if category and subcategory are not selected, show all products
        // if category is selected, show all products in that category
        // if subcategory is selected, show all products in that subcategory
        // if category and subcategory are selected, show all products in that category and subcategory
        // if keyword is entered, show all products that contain the keyword
        // if keyword is not entered, show all products

        // if user is logged in, show all products that user has favourited
        // if user is not logged in, show all products

        

        
        $request = request();
        $user_id = (Auth::check()) ? auth()->user()->id : 0;

        $products = Product::with('product_variances:id,product_id,price','product_media:id,product_id,media_url',
                                  'Subcategory.Category:id,name','favourites:user_id,product_id')
        ->when($request->has('keyword'), function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->keyword . '%');
        })
        // search by category_id in subcategory table
        ->when($request->has('category'), function ($query) use ($request) {
            return $query->whereHas('Subcategory', function ($query) use ($request) {
                return $query->where('category_id', $request->category);
            });
        })
        ->when($request->has('subcategory'), function ($query) use ($request) {
            return $query->where('subcategory_id', $request->subcategory);
        })
        ->when($request->has('category') && $request->has('subcategory'), function ($query) use ($request) {
            return $query->where('subcategory_id', $request->subcategory);
        })

        ->whereHas('product_variances')
        ->whereHas('product_media')
    
        ->paginate(15);
        //dd($products[0]);
       
        return view('welcome', compact('products', 'request'));
        //dd($products);
        //return view('welcome', ['products' => $products]);

        // $subcategory = ProductController::getSubcategories($request);
        // $keyword = $request->keyword;
        // $subcategory = Product::get('subcategory_id')->last()->toArray();
      
        // // $keyword = "حقيبة قماشية";
        //     $products = Product::with('product_variances:id,product_id,price','product_media:id,product_id,media_url')
        //     ->where('products.name', 'like', "%$keyword%")->get() ?? Product::get()
        // //     ->with( $subcategory)
        // //     ->get();
        // // dd($products);
        //       ->select('products.*')
        //       ->wherein($subcategory,'products.subcategory_id')
        //     // //   ->whereIn('products.subcategory_id', )
        //      ->where('products.is_deleted', false)
        //       //->join('product_variances', 'products.id' ,'=', 'product_variances.product_id')
             
         
        //     //   ->with('product_variances', function ($join){
        //     //     $join->on('products.id' ,'=', 'product_variances.product_id')->limit(1);
        //     //   })

        //       ///////->wherein('products.subcategory_id',Product_media::get('product_media.product_id'));
        //       //->wherein('product_variances.product_id','=','products.id')
        //       // ->lefjoin('product_variance', function ($join){
        //       //   $join->on('products.id' ,'=', 'product_variance.product_id')->limit(1);
        //       // })

        //       // ->join('subcategory', function ($join){
        //       //   $join->on('products.subcategory_id' ,'=', 'subcategories.id')->limit(1);
        //       // })

        //       // ->join('category', function ($join){
        //       //   $join->on('subcategories.category_id' ,'=', 'categories.id')->limit(1);
        //       // })

            
              
        //     //   ->join('product_media', 'product_media.product_id', '=', 'products.id')
        //     // //   ->where('product_media.media_url', '!=', null)
        //     //   ->leftjoin('subcategories', 'subcategory_id', '=', 'subcategories.id')
        //     //   ->leftjoin('categories', 'categories.id', '=', 'subcategories.category_id')
        //      ->select(
                
        //         'product_variances.price as price',
        //         'product_media.media_url as image',
        //         'products.name as name',
        //         'products.id as id',
        //         'products.subcategory_id as subcategory_id',

        //         // 'subcategories.name as subcategor',
        //         // 'categories.name as category'
        //          )
             
        //       ->paginate(15);
              
              
              

        //       foreach ($products as $product) {
        //         $product->image = Product_media::find($product->id,'product_id')->first()->media_url;
        //         $product->price = Product_variance::find($product->id,'product_id')->first()->price;
        //         $product->subcategory = Subcategory::find($product->subcategory_id)->first()->name;
        //         $product->category_id = Subcategory::find($product->subcategory_id)->first()->category_id;
        //         $product->category = Category::find($product->category_id)->first()->name;
        //         $product->favourite = Favourite::where('user_id', $user_id)->where('product_id',$product->id)->first() ? true : false;
        //         //dd($product->price->price);
        //         }
        //         //dd($products);
            
        
        // return view('welcome', ['products' => $products]);
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
        // delete a product from products table
        $product->delete();

    }
  
}
