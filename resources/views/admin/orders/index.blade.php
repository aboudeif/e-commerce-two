<x-app-layout>
    
    
                    <div class="card" dir="rtl">
                        <div class="card-header w-full py-2 ">
                            <h3 class="card-title inline float-right">الطلبات</h3>
                            
                        </div>
                     
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                      
                                        <th>تاريخ الطلب</th>
                                        <th>اسم المستخدم</th>
                                        <th>حالة الطلب</th>
                                        <th>عدد المنتجات</th>
                                        <th>السعر الإجمالي</th>
                                        <th>إجمالي الخصومات</th>
                                        <th>مصاريف الشحن</th>
                                        <th>النقاط</th>
                                        <th>الضريبة</th>
                                        <th>طريقة الدفع</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    
                                    <tr style="z-index: 999; cursor:pointer;" onclick="showOrder('{{ $order->id }}');">
                                       
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->OrderProcess[0]->order_process }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ $order->price }}</td>
                                        <td>{{ $order->discount }}</td>
                                        <td>{{ $order->shipping }}</td>
                                        <td>{{ $order->points }}</td>
                                        <td>{{ $order->tax }}</td>
                                        <td>{{ $order->payment_method }}</td>
                            
                                    </tr>
                                    
                                    
                                    @endforeach
                                    <script>
                                        function showOrder(id){
                                            window.location.href = "/admin/order/show?id=" + id;
                                        }
                                    </script>
                                </tbody>
                            </table>
                        </div>
                        {{-- links
                        <div class="card-footer clearfix">
                            <ul class="pagination m-0 float-right">
                                {{ $orders->links() }}
                            </ul>
                        </div> --}}
    
                        
                    </div>
    
                  
    </x-app-layout>
    