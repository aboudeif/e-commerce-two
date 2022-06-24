<x-app-layout>
    {{-- payment checkout: choose user shipping address from shippingAddresses table --}}
    <div class="container">
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


    