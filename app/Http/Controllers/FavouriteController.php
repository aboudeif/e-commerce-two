<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
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

    $favourites = Product::with('product_variances:id,product_id,price','product_media:id,product_id,media_url',
                                'Subcategory.Category:id,name','favourites:user_id,product_id')
    ->whereHas('favourites', function ($query) use ($user_id) {
        return $query->where('user_id', $user_id);
        })

    ->whereHas('product_variances')
    ->whereHas('product_media')

    ->paginate(15);
    
    return view('user.favourites', compact('favourites', 'request'));

    }

    // /**
    //  * Display a listing of the resource in json.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function indexApi()
    // {
    //    //
    // $request = request();
    // $user_id = auth()->user()->id;

    // $products = Product::with('product_variances:id,product_id,price','product_media:id,product_id,media_url',
    //                             'Subcategory.Category:id,name','favourites:user_id,product_id')
    // ->whereHas('favourites', function ($query) use ($user_id) {
    //     return $query->where('user_id', $user_id);
    //     })

    // ->whereHas('product_variances')
    // ->whereHas('product_media')->get();
    
    // foreach($products as $product){
    // $favourites[] =
    // "<x-jet-dropdown-link href=". route('favourites.index') ." >                   
    // <img src=". $product->product_media->first()->media_url ." alt=". $product->name ." class='img-fluid'>
    // <b class='font-bold text-xl mb-2 text-right px-3'>
    //     <a href=". route('products.show', $product->id) .">". $product->name ."</a>
    // </b>
    // <span class='text-gray-700 text-right px-3'>
    //     ". $product->product_variances->first()->price . " " . " EGP
    // </span>
    // </x-jet-dropdown-link>";
    // }
    // //return response()->json($favourites);
    //  //['favourites' => $favourites];
    // //dd($favourites);
    //  // return data as a JSON response
    // return response()->json($products);
    


        
    // }
    

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
        $status = Favourite::where('user_id', $user)
                           ->where('product_id',$product)
                           ->first();

        if($status != true)
        {
            Favourite::insert(['user_id'=> $user, 'product_id'=> $product]);
            return['action' => 'add', 'id' => $product, 'status' => 'success'];
        }

        elseif($status == true)
        {
            self::destroy($user,$product);
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

    public function destroy($user,$product){
        Favourite::where('user_id', $user)->where('product_id',$product)->delete();
    }


}

