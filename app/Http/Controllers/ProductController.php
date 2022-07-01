<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
    public function index(Request $request)
    {
        //
  
        foreach($request->query as $item => $value){
            if($value === null){
                unset($request[$item]);
        }}

        $user_id = (Auth::check()) ? auth()->user()->id : 0;

        if($request->from !== null && $request->to != null){
            $request->query->price_range = [$request->to,$request->from];
            unset($request['from']);
            unset($request['to']);
        }
        //dd($request);
        
        //dd(implode('-',$request->query->price_range));
        $products = Product::with('product_variances:id,product_id','product_media:id,product_id,media_url',
                                  'Subcategory.Category:id,name','favourites:user_id,product_id','carts:user_id,product_id')
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
        // ->when($request->has('category') && $request->has('subcategory'), function ($query) use ($request) {
        //     return $query->where('subcategory_id', $request->subcategory);
        // })
        ->when($request->has('to'), function ($query) use ($request) {
            return $query->whereHas('product_variances', function ($query) use ($request) {
                return $query->where('price', '<=', $request->to);
            });
        })
        ->when($request->has('from'), function ($query) use ($request) {
            return $query->whereHas('product_variances', function ($query) use ($request) {
                return $query->where('price', '>=', $request->from);
            });
        })
        
        ->when($request->query->has('price_range'), function ($query) use ($request) {
            return $query->whereHas('product_variances', function ($query) use ($request) {
                return $query->whereBetween('price', $request->query->price_range);
            });
        })

        ->when($request->has('order'), function ($query) use ($request) {
            return $query->orderBy('updated_at', $request->order);
        })
        // filter by color
        ->when($request->has('color'), function ($query) use ($request) {
            return $query->whereHas('product_variances', function ($query) use ($request) {
                return $query->where('color', $request->color);
            });
        })
        // filter by size
        ->when($request->has('size'), function ($query) use ($request) {
            return $query->whereHas('product_variances', function ($query) use ($request) {
                return $query->where('size', $request->size);
            });
        })

        // // filter by updated_at sort
        // ->when($request->has('order'), function ($query) use ($request) {
        //     return $query->order('updated_at', $request->order);
        // })
        

        ->whereHas('product_variances')
        ->whereHas('product_media')
    
        ->paginate(15);
        //dd($products[0]->favourites->first()->user_id);
        return view('welcome', compact('products', 'request'));
 
        }

    /**
     * index for admin
     * @return \Illuminate\Http\Response
     */
    public function admin_index()
    {
        //
        $request = request();

        $products = Product::with('product_variances:id,product_id,price,size,quantity,color,color_code,created_at,updated_at','product_media:id,product_id,media_url',
                                  'Subcategory.Category:id,name')
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
        ->when($request->has('price'), function ($query) use ($request) {
            return $query->whereHas('product_variances', function ($query) use ($request) {
                return $query->where('price', '<=', $request->price);
            });
        })
        ->when($request->has('price_range'), function ($query) use ($request) {
            return $query->whereHas('product_variances', function ($query) use ($request) {
                return $query->whereBetween('price', explode('-', $request->price_range));
            });
        })
        ->when($request->has('sort'), function ($query) use ($request) {
            return $query->orderBy($request->sort, 'desc');
        })


        ->whereHas('product_variances')
        ->whereHas('product_media')

        ->paginate(50);

        return view('admin.products.index', compact('products', 'request'));
      


    }

    /**
     * check if product is in cart
     */
    public function is_in_cart($product_id)
    {
        //
        
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $cart = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();
        if($cart)
        {
            return true;
        }
        else
        {
            return false;
        }
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
