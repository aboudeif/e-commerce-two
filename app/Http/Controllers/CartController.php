<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product_variance;

class CartController extends Controller
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
    $user_id = auth()->user()->id;

    $products = Product::with(
        'product_variances:id,product_id',
        'product_media:id,product_id,media_url',
            )
    ->whereHas('carts', function ($query) use ($user_id) {
        return $query->where('user_id', $user_id);
        })

    ->whereHas('product_variances')
    ->whereHas('product_media');
    return view('user.cart',['cart' => $products]);

    }
    public function is_in_cart()
    {
        $request = request();
        $user_id = auth()->user()->id;
        $product_id = $request->product_id;
        $product_variance_id = $request->product_variance_id;
        $cart = Cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('product_variance_id', $product_variance_id)
            ->first();
        if ($cart) {
            return response()->json(['status' => 'success', 'message' => 'Product is in cart']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Product is not in cart']);
        }
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
        $user = auth()->user()->id;
        $product_variance = Product_variance::where('color', $request->color)
                                            ->where('size', $request->size)
                                            ->first();
        $product = Product::find($product_variance->product_id);
        $status = Cart::where('user_id', $user)
                      ->where('product_id',$product->id)
                      ->where('product_variance_id',$product_variance->id)
                      ->first();
        if($status != true)
        {
            
            Cart::insert([
                'user_id'=> $user,
                'product_variance_id'=>$product_variance->id,
                'product_id'=> $product->id,
                'quantity'=> $request->quantity,
                'price' => $product->price,

            ]);
            return response()->json([
                'action' => 'add',
                'id' => $product->id,
                'product_variance_id'=> $product_variance->id,
                'status' => 'success',
            ]);
            
        }

        elseif($status == true)
        {
            Cart::where('user_id', $user)
                ->where('product_id',$product->id)
                ->where('product_variance_id',$product_variance->id)
                ->delete();

            return response()->json([
                'action' => 'remove',
                'id' => $product->id, 
                'product_variance_id'=> $product_variance->id,
                'status' => 'success',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //delete cart
        $user = auth()->user()->id;
        Cart::where('user_id', $user)
            ->delete();
    }
}
