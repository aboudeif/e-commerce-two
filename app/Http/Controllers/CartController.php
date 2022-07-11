<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Product_media;
use Illuminate\Http\Request;
use App\Models\Product_variance;
use App\Models\Subcategory;

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
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        // add products
        foreach ($cart as $item) {
            $item->product = Product::find($item->product_id);
            $item->product->media = Product_media::where('product_id', $item->product_id)->get();
            $item->product->variance = Product_variance::find($item->product_variance_id);
            $item->total = ($item->product->price - $item->discount) * $item->quantity;
        }
        // sum total of all cart items
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->total;
        }

        //   dd($cart);
        return view('user.cart', ['cart' => $cart, 'total' => $total]);

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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Product_variance::where('id', $request->product_variance_id)
            ->update([
                'quantity' => $request->quantity,
            ]);
        Cart::where('user_id', auth()->user()->id)
            ->where('product_variance_id', $request->id)
            ->update(['quantity' => $request->quantity]);
        // update quantity

        
        return response()->json(['status' => 'success', 'message' => 'Cart updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    
        //delete cart
        $user = auth()->user()->id;
        Cart::where('user_id', $user)
            ->where('product_variance_id', $request->id)
            ->delete();
            return redirect('/cart');
    }

    public function remove_all()
    {
        $user = auth()->user()->id;
        Cart::where('user_id', $user)
            ->delete();
    }

}
