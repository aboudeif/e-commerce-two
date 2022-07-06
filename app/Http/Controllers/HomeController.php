<?php

namespace App\Http\Controllers;

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

            return view('/user/home');
        }
    }
     // redirect to profile if user or dashboard if admin
    // public function mypage(){

    //     if(Auth::user()->usertype == true)
    //         return redirect ('/dashboard');
    //     else
    //         return redirect ('/profile/show');
    // }
}
