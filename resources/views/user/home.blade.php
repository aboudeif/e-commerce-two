<x-app-layout>
    {{-- customer dashboard --}}
    {{-- card for orders created by user --}}
    
    
    <?php $orders = []; ?>
    <div class="card w-1/2 my-3 mx-3" dir="rtl">
        {{-- card header and close card using js --}}
        <div class="card-header">
            <b class="card-title">الطلبات السابقة</b>
            
            <button type="button" class="close absolute left-0 ml-2 " data-dismiss="card" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    
            </div>
            {{-- ajax chart of orders details --}}
            <div class="card-body">
            <div class="chart">
                <canvas id="ordersChart" style="height:230px"></canvas>
            </div>
            </div>

        
        {{-- /.card-body --}}
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



        
        <!-- /.card-header -->
        {{-- <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
            <th style="width: 10px">#</th>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Order Status</th>
            <th>Order Total</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @isset($orders)
            @foreach($orders as $order)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->id }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->total }}</td>
            <td>
                <a href="{{ route('user.order.show', $order->id) }}" class="btn btn-primary">View</a>
            </td>
            
            </tr>
            @endforeach
            @endisset
            </tbody>
        </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          {{ $orders->links() }}
        </ul>
        </div>
    </div> --}}
    {{-- card for orders created by user --}}


</x-app-layout>
    