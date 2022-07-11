<x-app-layout>

                <div class="card" dir="rtl">
                    <div class="card-header w-full py-2">
                        <h3 class="card-title inline text-center bg-warning text-white px-5 rounded-2">بيانات الطلب</h3>
                       
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" >تاريخ الطلب</x-jet-label>
                            <x-jet-label class="inline" value="{{ $order->created_at->format('Y-m-d') }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" >حالة الطلب</x-jet-label>
                            <x-jet-label class="inline" value="{{ $order->OrderProcess[0]->order_process }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">عدد المنتجات</x-jet-label>
                            <x-jet-label class="inline" value="{{ $order->quantity }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">السعر الإجمالي</x-jet-label>
                            <x-jet-label class="inline" value="{{ $order->price }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">إجمالي الخصومات</x-jet-label>
                            <x-jet-label class="inline" value="{{ $order->discount }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">مصاريف الشحن</x-jet-label>
                            <x-jet-label class="inline" value="{{ $order->shipping }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">النقاط</x-jet-label>
                            <x-jet-label class="inline" value="{{ $order->points }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الضريبة</x-jet-label>
                            <x-jet-label class="inline" value="{{ $order->tax }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">طريقة الدفع</x-jet-label>
                            <x-jet-label class="inline" value="{{ $order->payment_method }}" />
                        </div>
                
                       
                            <span class="card-title w-auto text-center bg-gray-500 text-white px-5 rounded-2">عنوان التسليم</span>
                            <div class="my-2">
                                <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الاسم</x-jet-label>
                                <x-jet-label class="inline" value="{{ $order->ShippingAddress->name}}" />
                            </div>
                            <div class="my-2">
                                <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">التليفون</x-jet-label>
                                <x-jet-label class="inline" value="{{ $order->ShippingAddress->phone}}" />
                            </div>
                            <div class="my-2">
                                <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">المدينة</x-jet-label>
                                <x-jet-label class="inline" value="{{ $order->ShippingAddress->city}}" />
                            </div>
                            <div class="my-2">
                                <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الرمز البريدي</x-jet-label>
                                <x-jet-label class="inline" value="{{ $order->ShippingAddress->zip}}" />
                            </div>
                            <div class="my-2">
                                <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">العنوان</x-jet-label>
                                <x-jet-label class="inline" value="{{ $order->ShippingAddress->address}}" />
                            </div>
                        
                    </div>
                </div>

                    
                    <!-- /.card-header -->



                    <div class="card-header w-full text-center my-5">
                        <h3 class="card-title inline rounded-2 mx-3 px-2 bg-gray-200">قائمة المنتجات</h3>
                        
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0 mx-5" dir="rtl">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>المنتج</th>
                                    <th>الكمية</th>
                                    <th>السعر</th>
                                    <th>الخصم</th>
                                    <th>النقاط</th>
                                    <th>إجمالي السعر</th>
                                    
                                </tr>
                            </thead>
                           
                            <tbody>
                                @foreach ($order->OrderItems as $order_item)
                                <tr class="cursor-pointer" onclick="showProduct('{{ $order_item->product_id }}')">
                                    
                                    <td>{{ $order_item->Product->name }}</td>
                                    <td>{{ $order_item->quantity }}</td>
                                    <td>{{ $order_item->price }}</td>
                                    <td>{{ $order_item->discount }}</td>
                                    <td>{{ $order_item->points }}</td>
                                    <td>{{ $order_item->total_price }}</td>
                                    
                                </tr>
                                @endforeach
                                <script>
                                    function showProduct(id){
                                        window.location.href = "/products/show?id=" + id;
                                    }
                                </script>
                            </tbody>
                        </table>
                    </div>
                    {{-- links --}}
                    @isset($order_items->links)
                   
                    <div class="card-footer clearfix">
                        <ul class="pagination m-0 float-right">
                            {{ $order_items->links() }}
                        </ul>
                    </div>
                    @endisset
                    <!-- /.card-body -->
                </div>

                <!-- /.card -->

{{-- end index catygories --}}
</x-app-layout>
