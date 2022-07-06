<x-app-layout>
    {{-- ajax get order details --}}
    <script>
        $(document).ready(function() {
            $('#order_id').change(function() {
                var order_id = $(this).val();
                $.ajax({
                    url: "{{ route('order.show') }}",
                    method: "GET",
                    data: {
                        order_id: order_id
                    },
                    success: function(data) {
                        $('#order_details').html(data);
                    }
                });
            });
        });
    </script>
    {{-- show order details --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Order Details</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ $product->pivot->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>Shipping Info</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('user.shipping_info.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="shipping_address">Shipping Address</label>
                        <select name="shipping_address" id="shipping_address" class="form-control">
                            @foreach ($shippingAddresses as $shippingAddress)
                                <option value="{{ $shippingAddress->id }}">{{ $shippingAddress->address }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>