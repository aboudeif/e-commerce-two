<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_variance;


class ProductVarianceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // index product variances
        $product_id = request('product_id');
        $product_variances = Product_variance::with('product')
            ->where('product_id', $product_id)
            ->get();
        return response()->json($product_variances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store product variances
        $product_variance = Product_variance::create(request()->all());
        return response()->json($product_variance);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show product variances
        $product_variance = Product_variance::find($id);
        return response()->json($product_variance);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //edit product variances
        $product_variance = Product_variance::find($id);
        return response()->json($product_variance);

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
        //update product variances
        $product_variance = Product_variance::find($id);
        $product_variance->update(request()->all());
        return response()->json($product_variance);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete product variances
        $product_variance = Product_variance::find($id);
        $product_variance->delete();
        return response()->json($product_variance);
    }
}
