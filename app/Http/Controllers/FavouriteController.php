<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Favourite;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('favourites', ['favourites' => Favourite::where('user_id', Auth::user()->id)->get()]);
        
    }

    /**
     * Display a listing of the resource in json.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexApi()
    {
        return Favourite::where('user_id', Auth::user()->id)->get()->toArray();
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $user = auth()->user()->id;
        $product = $request->product_id;
        $status = Favourite::where('user_id', $user)->where('product_id',$product)->first();

        if($status != true)
        {
            Favourite::insert(['user_id'=> $user, 'product_id'=> $product]);
            return['action' => 'add', 'id' => $product, 'status' => 'success'];
        }

        elseif($status == true)
        {
            Favourite::where('user_id', $user)->where('product_id',$product)->delete();
            return ['action' => 'remove', 'id' => $product, 'status' => 'success'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id){

    }


}

