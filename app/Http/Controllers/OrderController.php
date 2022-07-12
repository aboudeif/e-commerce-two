<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderProcess;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Self_;

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
        $orders = Order::where('user_id', auth()->user()->id)
                        ->with('OrderProcess:id,order_id,order_process')
                        ->get();
        
        return view('user/orders/index', ['orders' => $orders]);

    }

    /**
     * display a listing of the resource for admin
     * @return \Illuminate\Http\Response
     *
     */
    public function admin_index(Request $request)
    {
        //
        $orders = Order::all();

        $orders->order_proccess = OrderProcess::where('order_id', $request->order_id)
        ->when($request->has('order_process'),function ($query) use ($request){
            return $query->where('order_process',$request->order_process);
        })
        ->select('id','order_id','order_process')
                                                ->get();
     
        return view('admin/orders/index', ['orders' => $orders]);

    }

    /**
     * show the form for creating a new resource for admin
     * @return \Illuminate\Http\Response
     */
    public function admin_show(Request $request)
    {
        //
      
        $order = Order::where('id', $request->order_id)
        ->with('OrderItems:id,order_id,product_id,product_variance_id,price,quantity,total_price,points,discount','OrderProcess:id,order_id,order_process'
        ,'ShippingAddress:id,user_id,address,city,zip,phone,name','OrderItems.Product:id,name')
        ->select('id','user_id','quantity','price','discount','tax','shipping','points','payment_method','shipping_address_id',
      'created_at','updated_at')
        ->get();

        //dd($order);
        return view('admin/orders/show', ['order'=>$order->first->created_at]);
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
        $orders = Order::with('user:id,name','order_items:id,order_id,product_id,price,quantity','product:id,name','product_variance:id,product_id,price')
        ->where('user_id', $user_id)
        ->get();
        //return orders in json format
        return response()->json($orders);

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
        $order = new Order;
        $user_id = (Auth::check()) ? auth()->user()->id : 0;
        $order->user_id = $user_id;
        $order->quantity = Cart::where('user_id', $user_id)->sum('quantity');
        $price = Cart::where('user_id', $user_id)->sum('price');

        $order->price = Cart::where('user_id', $user_id)->sum('quantity') * $price;
        $order->discount = Cart::where('user_id', $user_id)->sum('discount');
        $order->tax = 0.14;
        $order->shipping = Cart::where('user_id', $user_id)->sum('shipping_fees');
        $order->points = Cart::where('user_id', $user_id)->sum('reward');
        $order->payment_method = 'cash';
        //$order->status = 'pending';
        // dd();
        $order->shipping_address_id = $request->request->get('shipping_id');

        $order->save();
        foreach (Cart::where('user_id', $user_id)
                     ->get() as $cart) {
            $order_item = new OrderItem;
            $order_item->order_id = $order->id;
            $order_item->product_id = $cart->product_id;
            $order_item->product_variance_id = $cart->product_variance_id;
            $order_item->points = $cart->reward;
            $order->discount = $cart->discount;
            $order_item->total_price = $cart->price * $cart->quantity;
            $order_item->price = $cart->price;
            $order_item->quantity = $cart->quantity;
            $order_item->save();
        }
        $order_proccess = new OrderProcess;
        $order_proccess->order_id = $order->id;
        $order_proccess->order_process = 'review';
        $order_proccess->save();
        Cart::where('user_id', $request->user_id)->delete();
        
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $order = Order::where('id', $request->order_id)
                      ->with('OrderItems:id,order_id,product_id,product_variance_id,price,quantity,total_price,points,discount','OrderProcess:id,order_id,order_process'
                      ,'ShippingAddress:id,user_id,address,city,zip,phone,name','OrderItems.Product:id,name')
                      ->select('id','user_id','quantity','price','discount','tax','shipping','points','payment_method','shipping_address_id',
                    'created_at','updated_at')
                      ->get();
                 
        return view('user/orders/show', ['order'=>$order->first->created_at]);

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

    /**
     * invoice order.
     *
     */
    public function invoice_order(Request $request)
    {
    
        
        // return view('user.invoice', ['order' => $order->with('user:id,name','order_items:id,order_id,product_id,price,quantity','product:id,name','product_variance:id,product_id,price')
        //                                               ->where('id', $order->id)
        //                                               ->first()]);

    }
}
