<x-app-layout>
    {{-- dummy data --}}
    <?php
   
    $order = (object)[
        'billing_name' => 'John Doe',
        'billing_address' => '123 Main St',
        'billing_city' => 'New York',
        'billing_state' => 'NY',
        'billing_zip' => '10001',
        'shipping_name' => 'John Doe',
        'shipping_address' => '123 Main St',
        'shipping_city' => 'New York',
        'shipping_state' => 'NY',
        'shipping_zip' => '10001',
        'total' => '100',
        'tax' => '10',
        'shipping' => '10',
        'grand_total' => '110',
        'products' => (object)[
            (object)[
            'id' => 1,
            'name' => 'Product 1',
            'price' => '100',
            'pivot' => (object)[
                'quantity' => 1,
                'total' => '100'
            ]   ],
        (object)[
            'id' => 2,
            'name' => 'Product 2',
            'price' => '200',
            'pivot' => (object)[
                'quantity' => 2,
                'total' => '400'
            ]   ],
        (object)[
            'id' => 3,
            'name' => 'Product 3',
            'price' => '300',
            'pivot' => (object)[
                'quantity' => 3,
                'total' => '900'
            ]   ],

        ]

    ];

    ?>

    {{--  order detailed invoice --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Invoice</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Billing Address</h3>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $order->billing_name }}</p>
                                        <p>{{ $order->billing_address }}</p>
                                        <p>{{ $order->billing_city }}</p>
                                        <p>{{ $order->billing_state }}</p>
                                        <p>{{ $order->billing_zip }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Shipping Address</h3>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $order->shipping_name }}</p>
                                        <p>{{ $order->shipping_address }}</p>
                                        <p>{{ $order->shipping_city }}</p>
                                        <p>{{ $order->shipping_state }}</p>
                                        <p>{{ $order->shipping_zip }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Order Items</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->products as $product)
                                                    <tr>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>{{ $product->pivot->quantity }}</td>
                                                        <td>{{ $product->price * $product->pivot->quantity }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Order Totals</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Total</th>
                                                    <th>Tax</th>
                                                    <th>Grand Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $order->total }}</td>
                                                    <td>{{ $order->tax }}</td>
                                                    <td>{{ $order->grand_total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- print button --}}
    <div class="row">
        <div class="col-md-12 text-center my-3">
            {{-- print only the invoice --}}
            {{-- <a href="{{ route('user.invoice', $order->id) }}" class="btn btn-primary">Print Invoice</a> --}}
        {{-- download invoice as pdf file --}}
            {{-- <a href="{{ route('user.invoice.pdf', $order->id) }}" class="btn btn-primary">Download Invoice</a> --}}
            
            <button class="btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>


    




</x-app-layout>

