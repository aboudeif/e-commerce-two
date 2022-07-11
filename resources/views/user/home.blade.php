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
                            <a href="{{ route('orders.show', ['order_id'=>$order->id]) }}">
                               
                            <tr class="cursor-pointer">
                               
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->OrderProcess[0]->order_process }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->discount }}</td>
                                <td>{{ $order->shipping }}</td>
                                <td>{{ $order->points }}</td>
                                <td>{{ $order->tax }}</td>
                                <td>{{ $order->payment_method }}</td>
                                


                            </tr>
                            </a>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
        <div class="card-footer">
        <div class="row">
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">مجموع الطلبات</span>
                <h5 class="description-header">{{ 5 }}</h5> <!--$orders->count()-->
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">قيمة المشتريات</span>
                <h5 class="description-header">{{ 18 }}</h5> <!--$orders->sum('total')-->
            </div>
             <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">التخفيضات والعروض</span>
                <h5 class="description-header">{{ 18 }}</h5> <!--$orders->sum('total')-->
            </div>
             <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">النقاط التي حصلت عليها</span>
                <h5 class="description-header">{{ 18 }}</h5> <!--$orders->sum('total')-->
            </div>
            <!-- /.description-block -->
            </div>


        </div>
        
       


</x-app-layout>
    