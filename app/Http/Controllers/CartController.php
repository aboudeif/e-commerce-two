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
        'product_variances:id,product_id,price',
        'product_media:id,product_id,media_url',
            )
    ->whereHas('carts', function ($query) use ($user_id) {
        return $query->where('user_id', $user_id);
        })

    ->whereHas('product_variances')
    ->whereHas('product_media');
    return view('user.cart',['products' => $products]);

    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function addToCart(Request $request)
    // {
    //     //
    //     $user = auth()->user()->id;
    //     $product = $request->product_id;
    //     $product_variance = $request->product_variance_id;
    //     $status = Cart::where('user_id', $user)
    //                   ->where('product_id',$product)
    //                   ->where('product_variance_id',$product_variance)
    //                   ->first();
    //     if($status != true)
    //     {
    //         Cart::insert([
    //             'user_id'=> $user,
    //             'product_id'=> $product,
    //             'product_variance_id',$product_variance,
    //         ]);
    //         return[
    //              'action' => 'add',
    //              'id' => $product,
    //              'product_variance_id'=> $product_variance,
    //               'status' => 'success',
    //             ];
    //     }
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function removeFromCart(Request $request)
    // {
    //     //
    //     $user = auth()->user()->id;
    //     $product = $request->product_id;
    //     $product_variance = $request->product_variance_id;
    //     $status = Cart::where('user_id', $user)
    //                   ->where('product_id',$product)
    //                   ->where('product_variance_id',$product_variance)
    //                   ->first();
    //     if($status == true)
    //     {
    //         Cart::where('user_id', $user)
    //             ->where('product_id',$product)
    //             ->where('product_variance_id',$product_variance)
    //             ->delete();

    //         return [
    //             'action' => 'remove',
    //             'id' => $product, 
    //             'product_variance_id'=> $product_variance,
    //             'status' => 'success',
    //         ];
    //     }
    // }

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
        $product_variance = $request->product_variance_id;
        $info = Product_variance::where('id', $product_variance)
                                    ->first();
        $status = Cart::where('user_id', $user)
                      ->where('product_id',$info->product_id)
                      ->where('product_variance_id',$product_variance)
                      ->first();
        if($status != true)
        {
            
            Cart::insert([
                'user_id'=> $user,
                'product_variance_id'=>$product_variance,
                'product_id'=> $info->product_id,
                'price' => $info->price,

            ]);
            return[
                 'action' => 'add',
                 'id' =>  $product_variance,
                 'status' => 'success',
                ];
        }

        elseif($status == true)
        {
            Cart::where('user_id', $user)
                ->where('product_id',$info->product_id)
                ->where('product_variance_id',$product_variance)
                ->delete();

            return [
                'action' => 'remove',
                'id' => $product_variance, 
                'status' => 'success',
            ];
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
        //
    }
}
