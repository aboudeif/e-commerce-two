<x-app-layout>

    <div class="container" dir="rtl">
        <div class="row">
            <div class="col-md-12">
                <h1>عنوان الشحن</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('orders.store') }}" method="POST" id="shipping-form">
                    @csrf
                    <div class="form-group">
                        @isset($shipping_address)
                            @foreach ($shipping_address as $shippingAddress)
                                <div class="card mx-2 my-2" dir="rtl">
                                    <div class="card-header w-full">
                                        <h3
                                            class="card-title inline text-center w-full bg-warning text-white px-5 rounded-2">
                                            {{ $shippingAddress->city }}</h3>

                                        <div class="form-check">
                                            <x-jet-input class="form-check-input float-right" type="radio"
                                                name="shipping_id"
                                                value="{{ $shippingAddress->id }}" checked />
                                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الاسم</x-jet-label>
                                            <x-jet-label class="form-check-label inline">
                                                {{ $shippingAddress->name }}
                                            </x-jet-label>

                                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">العنوان
                                            </x-jet-label>
                                            <x-jet-label class="form-check-label inline">
                                                {{ $shippingAddress->address }}
                                            </x-jet-label>

                                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">المدينة
                                            </x-jet-label>
                                            <x-jet-label class="form-check-label inline">
                                                {{ $shippingAddress->city }}
                                            </x-jet-label>

                                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الرقم البريدي
                                            </x-jet-label>
                                            <x-jet-label class="form-check-label inline">
                                                {{ $shippingAddress->zip }}
                                            </x-jet-label>

                                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الهاتف</x-jet-label>
                                            <x-jet-label class="form-check-label inline">
                                                {{ $shippingAddress->phone }}
                                            </x-jet-label>

                                        </div>
                                    </div>
                            @endforeach
                        @endisset

                    </div>


                </form>
            </div>
        </div>
    </div>
        <div class="card my-2" dir="rtl">
            <div class="card-header">
                <div class="form-group">
                    <x-jet-label class="mr-2" for="name">الاسم</x-jet-label>
                    <x-jet-input type="text" class="my-2 form-control" id="shipping_name" required />
                </div>
                <div class="form-group">
                    <x-jet-label class="mr-2" for="address">العنوان</x-jet-label>
                    <x-jet-input type="text" class="my-2 form-control" id="address" required />
                </div>
                <div class="form-group">
                    <x-jet-label class="mr-2" for="city">المدينة</x-jet-label>
                    <x-jet-input type="text" class="my-2 form-control" id="city" required />
                </div>
                <div class="form-group">
                    <x-jet-label class="mr-2" for="zip">الرقم البريدي</x-jet-label>
                    <x-jet-input type="text" class="my-2 form-control" id="zip" required />
                </div>
                <div class="form-group">
                    <x-jet-label class="mr-2" for="phone">رقم الهاتف</x-jet-label>
                    <x-jet-input type="text" class="my-2 form-control" id="phone" required />
                </div>
                <x-jet-button type="button" class="my-2" onclick="storeAddress();">
                    إضافة عنوان جديد
                </x-jet-button>
            </div>
        </div>

        <script>
            function storeAddress() {
                var name = document.getElementById('shipping_name').value;
                var address = document.getElementById('address').value;
                var city = document.getElementById('city').value;
                var zip = document.getElementById('zip').value;
                var phone = document.getElementById('phone').value;
                var data = {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    address: address,
                    city: city,
                    zip: zip,
                    phone: phone
                };
                $.ajax({
                    type: 'POST',
                    url: '{{ route('shipping.store') }}',

                    data: data,

                    success: function(data) {
                        window.location.reload();
                    },
                    faild: function(data) {
                        console.log(data);
                    }
                });
            }
        </script>

    
    <x-jet-button
        form="shipping-form"
        type="submit"
        class="form-group btn bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-1 px-4 rounded-full">
        المتابعة إلي الشراء
    </x-jet-button>


</x-app-layout>
