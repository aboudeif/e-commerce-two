<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //index shipping addresses
        $shipping_addresses = ShippingAddress::with('user')
            ->get();
        return response()->json($shipping_addresses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create shipping address
        $shipping_address = ShippingAddress::where('user_id',auth()->user()->id)->get();
        return view('user.shipping_info',['shipping_address' => $shipping_address]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store shipping address
        $shipping_address = new ShippingAddress;
        $shipping_address->user_id = auth()->user()->id;
        $shipping_address->name = $request->name;
        $shipping_address->address = $request->address;
        $shipping_address->city = $request->city;
        $shipping_address->zip = $request->zip;
        $shipping_address->phone = $request->phone;
        $shipping_address->save();
        return response()->json(['status' => 'success', 'message' => 'Shipping address created']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingAddress  $shippingAddress
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingAddress $shippingAddress)
    {
        //show shipping address
        return view('user.shipping', ['shippingAddress' => $shippingAddress]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingAddress  $shippingAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingAddress $shippingAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShippingAddress  $shippingAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingAddress $shippingAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShippingAddress  $shippingAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingAddress $shippingAddress)
    {
        //
    }
}
