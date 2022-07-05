<x-app-layout>

    <div class="container" dir="rtl">
        <div class="row">
            <div class="col-md-12">
                <h1>عنوان الشحن</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('shipping.store') }}" method="POST">
                    @csrf
                    <div class="form-group">

                        @foreach ($shippingAddresses as $shippingAddress)
                            {{-- card for shipping address with checkbox --}}
                            <div class="card mx-2 my-2" dir="rtl">
                                <div class="card-header w-full">
                                    <h3 class="card-title inline ">{{ $shippingAddress->city }}</h3>
                                    <h3 class="card-title inline ">{{ $shippingAddress->zip }}</h3>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipping_address"
                                            id="I_{{ $shippingAddress->id }}" value="{{ $shippingAddress->id }}"
                                            required>
                                        <label class="form-check-label" for="shipping_address">
                                            {{ $shippingAddress->address }}
                                        </label>
                                        <label class="form-check-label" for="shipping_address">
                                            {{ $shippingAddress->city }}
                                        </label>
                                        <label class="form-check-label" for="shipping_address">
                                            {{ $shippingAddress->zip }}
                                        </label>
                                        <label class="form-check-label" for="shipping_address">
                                            {{ $shippingAddress->phone }}
                                        </label>

                                    </div>
                                </div>
                        @endforeach

                        <div class="card mx-2 my-2" dir="rtl">
                            <div class="card-header w-full">
                                <h3 class="card-title inline ">{{ $shippingAddress->city }}</h3>
                                <h3 class="card-title inline ">{{ $shippingAddress->zip }}</h3>

                                <div class="form-check" dir="rtl">
                                    <input class="form-check-input" type="radio" name="shipping_address"
                                        id="I_new" name="I_new" value="{{ $shippingAddress->id }}"
                                        required>
                                    <label class="form-check-label" for="shipping_address">
                                        {{ $shippingAddress->address }}
                                    </label>
                                    <label class="form-check-label" for="shipping_address">
                                        {{ $shippingAddress->city }}
                                    </label>
                                    <label class="form-check-label" for="shipping_address">
                                        {{ $shippingAddress->zip }}
                                    </label>
                                    <label class="form-check-label" for="shipping_address">
                                        {{ $shippingAddress->phone }}
                                    </label>

                                </div>
                            </div>


                        </div>
                        <div class="form-group">
                            <x-jet-button type="submit">Next</x-jet-button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
