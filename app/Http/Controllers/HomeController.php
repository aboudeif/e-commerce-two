<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * home function
     */
    public function home(){
        $user = Auth::user();
        return redirect('/products');
        
    }
    // // redirect to dashboard if user is authenticated
    public function redirect(){

        if(Auth::check()){

        if(Auth::user()->usertype == true)

            return view('/admin/home');

        else
        $orders = Order::where('user_id', auth()->user()->id)
                        ->with('OrderProcess:id,order_id,order_process')
                        ->get();
        
        
         
            return view('/user/home', ['orders' => $orders]);
        }
    }
    
}
