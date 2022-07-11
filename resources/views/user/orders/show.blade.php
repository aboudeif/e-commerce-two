<x-app-layout>
{{-- index catygories --}}

{{-- {{ dd($order->OrderItems->first->id->id) }} --}}
                <div class="card" dir="rtl">
                    {{-- selected category information --}}
                    <div class="card-header w-full py-2 ">
                        <h3 class="card-title inline text-center w-full bg-warning text-white px-5 rounded-2">بيانات الطلب</h3>
                       
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" >تاريخ الطلب</x-jet-label>
                            <x-jet-label class="inline" value="{{ $order->created_at->format('Y-m-d') }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" >حالة الطلب</x-jet-label>
                            <x-jet-label class="inline" value="{{ $order->id  }}" />
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

                    </div>
                    <!-- /.card-header -->



                    <div class="card-header w-full ">
                        <h3 class="card-title inline float-right">المنتجات</h3>
                        
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
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
                                <tr>
                                    
                                    <td>{{ $order_item->id }}</td>
                                    <td>{{ $order_item->quantity }}</td>
                                    <td>{{ $order_item->price }}</td>
                                    <td>{{ $order_item->discount }}</td>
                                    <td>{{ $order_item->points }}</td>
                                    <td>{{ $order_item->total_price }}</td>

                                    
                                </tr>
                                @endforeach
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
