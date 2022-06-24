<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;


class OrderController extends Controller
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
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        // index orders
        $orders = Order::with('user:id,name','order_items:id,order_id,product_id,price,quantity','product:id,name','product_variance:id,product_id,price')
        ->when($request->has('keyword'), function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->keyword . '%');
        })
        ->when($request->has('sort'), function ($query) use ($request) {
            return $query->orderBy($request->sort, 'desc');
        })
        ->when($request->has('status'), function ($query) use ($request) {
            return $query->where('status', $request->status);
        })
        ->when($request->has('user_id'), function ($query) use ($request) {
            return $query->where('user_id', $request->user_id);
        })
        ->when($request->has('date'), function ($query) use ($request) {
            return $query->where('created_at', 'like', '%' . $request->date . '%');
        })
        ->when($request->has('date_range'), function ($query) use ($request) {
            return $query->whereBetween('created_at', explode('-', $request->date_range));
        })
        ->paginate(10);

        return view('orders.index', compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create new order
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $products = Product::with('product_variances:id,product_id,price','product_media:id,product_id,media_url',
                                  'Subcategory.Category:id,name','favourites:user_id,product_id','carts:user_id,product_id')
        ->get();
        return view('orders.create', compact('products'));



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store new order
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $order = new Order();
        $order->user_id = $user_id;
        $order->status = 'pending';
        $order->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // show order
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $order = Order::with('user:id,name','order_items:id,order_id,product_id,price,quantity','product:id,name','product_variance:id,product_id,price')
        ->where('id', $order->id)
        ->first();
        return view('orders.show', compact('order'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        // edit order
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $products = Product::with('product_variances:id,product_id,price','product_media:id,product_id,media_url',
                                  'Subcategory.Category:id,name','favourites:user_id,product_id','carts:user_id,product_id')
        ->get();
        return view('orders.edit', compact('order','products'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // update order
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $order->user_id = $user_id;
        $order->status = 'pending';
        $order->save();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        // delete order
        Order::where('id', $order->id)
        ->delete();

    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Order  $order
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show_order_items(Order $order)
    // {
    //     // show order items
    //     $user_id = (Auth::check()) ? auth()->user()->id : 0;
    //     $order = Order::with('user:id,name','order_items:id,order_id,product_id,price,quantity','product:id,name','product_variance:id,product_id,price')
    //     ->where('id', $order->id)
    //     ->first();
    //     return view('orders.show_order_items', compact('order'));

    // }

    /**
     * Process the order.
     */
    public function process_order(Request $request)
    {
        // process order
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $order = Order::with('user:id,name','order_items:id,order_id,product_id,price,quantity','product:id,name','product_variance:id,product_id,price')
        ->where('id', $request->order_id)
        ->first();
        $order->status = 'processed';
        $order->save();

    }

    /**
     * Cancel the order.
     */
    public function cancel_order(Request $request)
    {
        // cancel order
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $order = Order::with('user:id,name','order_items:id,order_id,product_id,price,quantity','product:id,name','product_variance:id,product_id,price')
        ->where('id', $request->order_id)
        ->first();
        $order->status = 'cancelled';
        $order->save();

    }

    /**
     * Mark the order as complete.
     */
    public function complete_order(Request $request)
    {
        // complete order
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $order = Order::with('user:id,name','order_items:id,order_id,product_id,price,quantity','product:id,name','product_variance:id,product_id,price')
        ->where('id', $request->order_id)
        ->first();
        $order->status = 'complete';
        $order->save();

    }

    /**
     * order shipping.
     */
    public function shipping_order(Request $request)
    {
        // shipping order
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $order = Order::with('user:id,name','order_items:id,order_id,product_id,price,quantity','product:id,name','product_variance:id,product_id,price')
        ->where('id', $request->order_id)
        ->first();
        $order->status = 'shipping';
        $order->save();

    }

    /**
     * order delivered.
     */
    public function delivered_order(Request $request)
    {
        // delivered order
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $order = Order::with('user:id,name','order_items:id,order_id,product_id,price,quantity','product:id,name','product_variance:id,product_id,price')
        ->where('id', $request->order_id)
        ->first();
        $order->status = 'delivered';
        $order->save();

    }

    /**
     * order returned.
     */
    public function returned_order(Request $request)
    {
        // returned order
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $order = Order::with('user:id,name','order_items:id,order_id,product_id,price,quantity','product:id,name','product_variance:id,product_id,price')
        ->where('id', $request->order_id)
        ->first();
        $order->status = 'returned';
        $order->save();

    }

    // /**
    //  * print invoice.
    //  *
    //  */
    // public function print_invoice(Request $request)
    // {
    //     // send invoice to local printer using lpr

    //     $user_id = (Auth::check()) ? auth()->user()->id : 0;
    //     $order = Order::with('user:id,name','order_items:id,order_id,product_id,price,quantity','product:id,name','product_variance:id,product_id,price')
    //     ->where('id', $request->order_id)
    //     ->first();
    //     $order->status = 'processed';
    //     $order->save();
        
    //     $order_items = OrderItem::with('product:id,name','product_variance:id,product_id,price')
    //     ->where('order_id', $request->order_id)
    //     ->get();

    //     $order_total = 0;
    //     foreach ($order_items as $order_item) {
    //         $order_total += $order_item->price * $order_item->quantity;
    //     }
    //     $order_total = number_format($order_total, 2);
    //     $order_date = date('d/m/Y', strtotime($order->created_at));
    //     $order_time = date('H:i:s', strtotime($order->created_at));
    //     $order_id = $order->id;
    //     $order_status = $order->status;
    //     $order_user = $order->user->name;
    //     $order_user_id = $order->user->id;
    //     $order_user_email = $order->user->email;
    //     $order_user_phone = $order->user->phone;
    //     $order_user_address = $order->user->address;
    //     $order_user_city = $order->user->city;
    //     $order_user_state = $order->user->state;
    //     $order_user_postcode = $order->user->postcode;
    //     $order_user_country = $order->user->country;
    //     // use PDF
    //     $pdf = PDF::loadView('orders.print_invoice',
    //                 compact('order_items',
    //                         'order_total',
    //                         'order_date',
    //                         'order_time',
    //                         'order_id',
    //                         'order_status',
    //                         'order_user',
    //                         'order_user_id',
    //                         'order_user_email',
    //                         'order_user_phone',
    //                         'order_user_address',
    //                         'order_user_city',
    //                         'order_user_state',
    //                         'order_user_postcode',
    //                         'order_user_country'));
        
    // }
}
