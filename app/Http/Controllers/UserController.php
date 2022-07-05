<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        //index users
        $users = User::paginate(15);
        return view('admin.users.index', ['users' => $users]);

    }

    /**
     * show user 
     * @param request $request
     * 
     */
    public function show(Request $request)
    {
        //show user
        $user = User::find($request->id);
        $orders = Order::where('user_id',$request->id)->get();
        return view('admin.users.show', ['user' => $user, 'orders' => $orders]);
    }

}
