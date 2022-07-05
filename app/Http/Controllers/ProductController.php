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
use App\Models\Order;
use App\Models\OrderItem;
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
        $products = Product::orderBy('created_at', 'desc')
                                    ->paginate(50);

        return view('admin.products.index', ['products' => $products]);

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
        return view('admin.products.create');
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
        $product->name = $request->prodName;
        $product->description = $request->prodDescription;
        $product->price = $request->prodPrice;
        $product->discount = $request->prodDiscount;
        $product->subcategory_id = $request->prodSubcat;
        $product->is_deleted = $request->prodIs_deleted;
        $product->save();
        return redirect('/admin/products/index');
    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // show a product
        $product = Product::find($request->id);
        $subcategory_name = Subcategory::find($product->subcategory_id)->name;
        $product->images = Product_media::where('product_id', $request->id)
                                        ->where('media_type', 'image')
                                        ->where('is_deleted', 0)
                                        ->get();
        $variances = Product_variance::where('product_id', $request->id)
                                        ->where('is_deleted', 0)
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(15);
                                  
        return view('admin.products.show', ['product' => $product, 'variances' => $variances, 'subcategory_name' => $subcategory_name]);
    }

    /**
     * show a product for user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show_user(Request $request){
        // show a product
        $product = Product::find($request->id);
        $product_media = Product_media::where('product_id', $request->id)
                                        ->where('media_type', 'image')
                                        ->where('is_deleted', 0)
                                        ->get();
        $product_variances = Product_variance::where('product_id', $request->id)
                                        ->where('is_deleted', 0)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
        
        

        return view('products.show', ['product' => $product, 'product_media' => $product_media, 'product_variances' => $product_variances]);
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
        return view('admin.products.edit', ['product' => $product]);
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
        $product = Product::find($request->prodId);
        $product->name = $request->prodName;
        $product->description = $request->prodDescription;
        $product->price = $request->prodPrice;
        $product->discount = $request->prodDiscount;
        $product->subcategory_id = $request->prodSubcat;
        $product->is_deleted = $request->prodIs_deleted;
        $product->save();
        return redirect('/admin/products?id='.$product->subcategory_id);
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
        if(!Product_variance::where('product_id', $product->id)->exists() && 
        !Product_media::where('product_id', $product->id)->exists() &&
        !OrderItem::where('product_id', $product->id)->exists())
        {
        $product->delete();
        return redirect('/admin/products/index');
        }
        else
        {
        $product->is_deleted = 1;
        $product->save();
        return redirect('/admin/products/index');
        }
        }

    
  
        /**
         * store a new image for a product
         *
         * @return \Illuminate\Http\Response
         */
        public function store_image(Request $request)
        {
            // store a new image for a product
            $product_media = new Product_media;
            $product_media->product_id = $request->product_id;
            $product_media->media_type = $request->media_type;
            $product_media->media_url = $request->media_url;
            $product_media->is_deleted = $request->is_deleted;
            $product_media->save();
            return redirect('/admin/products/show?id='.$request->product_id);
        }

        /**
         * store a new variant for a product
         *
         * @return \Illuminate\Http\Response
         */
        public function store_variance(Request $request)
        {
            // store a new variant for a product
            $product_variance = new Product_variance;
            $product_variance->product_id = $request->product_id;
            $product_variance->variance_name = $request->variance_name;
            $product_variance->variance_price = $request->variance_price;
            $product_variance->is_deleted = $request->is_deleted;
            $product_variance->save();
            return redirect('/admin/products/show?id='.$request->product_id);
        }

        /**
         * delete a product image
         *
         * @return \Illuminate\Http\Response
         */
        public function delete_image(Request $request)
        {
            // delete a product image
            $product_media = Product_media::find($request->id);
            $product_media->is_deleted = 1;
            $product_media->save();
            return redirect('/admin/products/show?id='.$request->product_id);
        }

        /**
         * delete a product variant
         *
         * @return \Illuminate\Http\Response
         */
        public function delete_variance(Request $request)
        {
            // delete a product variant
            $product_variance = Product_variance::find($request->id);
            $product_variance->is_deleted = 1;
            $product_variance->save();
            return redirect('/admin/products/show?id='.$request->product_id);
        }

        /**
         * update a product image
         *
         * @return \Illuminate\Http\Response
         */
        public function update_image(Request $request)
        {
            // update a product image
            $product_media = Product_media::find($request->id);
            $product_media->media_type = $request->media_type;
            $product_media->media_url = $request->media_url;
            $product_media->is_deleted = $request->is_deleted;
            $product_media->save();
            return redirect('/admin/products/show?id='.$request->product_id);
        }

        /**
         * update a product variant
         *
         * @return \Illuminate\Http\Response
         */
        public function update_variance(Request $request)
        {
            // update a product variant
            $product_variance = Product_variance::find($request->id);
            $product_variance->variance_name = $request->variance_name;
            $product_variance->variance_price = $request->variance_price;
            $product_variance->is_deleted = $request->is_deleted;
            $product_variance->save();
            return redirect('/admin/products/show?id='.$request->product_id);
        }

        /**
         * edit a product image
         * @return \Illuminate\Http\Response
         *
         */
        public function edit_image(Request $request)
        {
            // edit a product image
            $product_media = Product_media::find($request->id);
            return view('admin.products.edit_image', ['product_media' => $product_media]);
        }

        /**
         * edit a product variant
         * @return \Illuminate\Http\Response
         *
         */
        public function edit_variance(Request $request)
        {
            // edit a product variant
            $product_variance = Product_variance::find($request->id);
            return view('admin.products.edit_variance', ['product_variance' => $product_variance]);
        }

        /**
         * show a product image
         * @return \Illuminate\Http\Response
         *
         */
        public function show_image(Request $request)
        {
            // show a product image
            $product_media = Product_media::find($request->id);
            return view('admin.products.show_image', ['product_media' => $product_media]);
        }

        /**
         * show a product variant
         * @return \Illuminate\Http\Response
         *
         */
        public function show_variance(Request $request)
        {
            // show a product variant
            $product_variance = Product_variance::find($request->id);
            return view('admin.products.show_variance', ['product_variance' => $product_variance]);
        }

        /**
         * create a new product image
         * @return \Illuminate\Http\Response
         * 
         */
        public function create_image(Request $request)
        {
            // create a new product image
            return view('admin.products.create_image', ['product_id' => $request->product_id]);
        }

        /**
         * create a new product variant
         * @return \Illuminate\Http\Response
         * 
         */
        public function create_variance(Request $request)
        {
            // create a new product variant
            return view('admin.products.create_variance', ['product_id' => $request->product_id]);
        }
    }
