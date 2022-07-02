<x-app-layout>
    {{-- customer dashboard --}}
    {{-- card for orders created by user --}}
    
    
    <?php $orders = []; ?>

    <div class="card w-3/12 my-3 mx-3" dir="rtl">
        {{-- card header and close card using js --}}
        <div class="card-header pt-2">
            <span class="card-title bg-success text-white py-1 px-2 absolute right-0">الطلبات</span>
            <x-jet-button class="card-title mt-5">الحالية</x-jet-button>
            <x-jet-button class="card-title">قيد الإنتظار</x-jet-button>
            <x-jet-button class="card-title">قيد الشحن</x-jet-button>
            <x-jet-button class="card-title">قيد التوصيل</x-jet-button>
            <x-jet-button class="card-title">قيد الإرتجاع</x-jet-button>
            <x-jet-button class="card-title">الملغاة</x-jet-button>
      
        {{-- /.card-body --}}
  
        <div class="row">
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">عدد الطلبات الحالية</span>
                <h5 class="description-header text-info">{{ 25 }}</h5> <!--$orders->count()-->
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-text">إجمالي عدد الطلبات</span>
                    <h5 class="description-header text-info">{{ 125 }}</h5> <!--$orders->count()-->
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">قيمة المشتريات الحالية</span>
                <h5 class="description-header text-success">{{ 1565 }} ج.م</h5> <!--$orders->sum('total')-->
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">الطلبات قيد المراجعة</span>
                <h5 class="description-header text-info">{{ 1565 }} </h5> <!--$orders->sum('total')-->
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">الطلبات قيد الشحن</span>
                <h5 class="description-header text-info">{{ 1565 }} </h5> <!--$orders->sum('total')-->
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">الطلبات قيد التوصيل</span>
                <h5 class="description-header text-info">{{ 1565 }} </h5> <!--$orders->sum('total')-->
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">الطلبات قيد الإرتجاع</span>
                <h5 class="description-header text-danger">{{ 1565 }} </h5> <!--$orders->sum('total')-->
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">الطلبات الملغاة</span>
                <h5 class="description-header text-danger">{{ 1565 }} </h5> <!--$orders->sum('total')-->
            </div>
            <!-- /.description-block -->
            </div>
        </div>
    </div>
</div>

{{-- users --}}
<div class="card w-3/12 my-3 mx-3" dir="rtl">
    {{-- card header and close card using js --}}
    <div class="card-header pt-2">
        <span class="card-title bg-success text-white py-1 px-2 absolute right-0">المستخدمين</span>
        
        <x-jet-button class="card-title mt-5">النشطين</x-jet-button>
        <x-jet-button class="card-title">المحظورين</x-jet-button>
    
    {{-- /.card-body --}}

    <div class="row">
        <div class="col-sm-3 col-6">
        <div class="description-block border-right">
            <span class="description-text">عدد المستخدمين</span>
            <h5 class="description-header text-info">{{ 25 }}</h5> <!--$orders->count()-->
        </div>
        <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">عدد المستخدمين النشطين</span>
                <h5 class="description-header text-success">{{ 125 }}</h5> <!--$orders->count()-->
        </div>
        <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
        <div class="description-block border-right">
            <span class="description-text">عدد المستخدمين المحظورين</span>
            <h5 class="description-header text-danger">{{ 1565 }}</h5> <!--$orders->sum('total')-->
        </div>
        <!-- /.description-block -->
        </div>
        <!-- /.col -->
    </div>
</div>
</div>


{{-- Categories --}}

<div class="card w-3/12 my-3 mx-3" dir="rtl">
    {{-- card header and close card using js --}}
    <div class="card-header pt-2">
        <span class="card-title bg-success text-white py-1 px-2 absolute right-0">التصنيفات</span>
        
        <x-jet-button class="card-title mt-5">النشطة</x-jet-button>
        <x-jet-button class="card-title">المحذوفة</x-jet-button>

    
    {{-- /.card-body --}}

    <div class="row">
        
        <!-- /.col -->
        <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">عدد التصنيفات الرئيسية</span>
                <h5 class="description-header text-success">{{ 125 }}</h5> <!--$orders->count()-->
        </div>
        <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">التصنيفات الرئيسية المحذوفة</span>
                <h5 class="description-header text-success">{{ 125 }}</h5> <!--$orders->count()-->
        </div>
        <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
        <div class="description-block border-right">
            <span class="description-text">عدد التصنيفات الفرعية</span>
            <h5 class="description-header text-success">{{ 1565 }}</h5> <!--$orders->sum('total')-->
        </div>
        <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
        <div class="description-block border-right">
            <span class="description-text">التصنيفات الفرعية المحذوفة</span>
            <h5 class="description-header text-success">{{ 1565 }}</h5> <!--$orders->sum('total')-->
        </div>
        <!-- /.description-block -->
        </div>
        <!-- /.col -->
    </div>
</div>
</div>

            
{{-- products --}}
<div class="card w-3/12 my-3 mx-3" dir="rtl">
    {{-- card header and close card using js --}}
    <div class="card-header pt-2">
        <span class="card-title bg-success text-white py-1 px-2 absolute right-0">المنتجات</span>
        
        <x-jet-button class=" mt-5">النشطة</x-jet-button>
        <x-jet-button>المحذوفة</x-jet-button>
        {{-- bold span --}}
        <b class=" "> {{ __(' - [ ') }}</b>
        {{-- small size x-jet-buttons --}}

        <x-jet-button style="background-color: rgb(0, 55, 139);"><small class="text-white">تحميل الصور</small></x-jet-button>
        <x-jet-button style="background-color: rgb(0, 55, 139);"><small class="text-white">قيد الكميات</small></x-jet-button>
        <b> {{ __(' ] ') }}</b>
    
    {{-- /.card-body --}}

    <div class="row">
        
        <!-- /.col -->
        <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-text">عدد المنتجات</span>
                <h5 class="description-header text-success">{{ 125 }}</h5> <!--$orders->count()-->
        </div>
        <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
        <div class="description-block border-right">
            <span class="description-text">عدد المنتجات المحذوفة</span>
            <h5 class="description-header text-danger">{{ 1565 }}</h5>
            </div>
            <!-- /.description-block -->
        </div>
    </div>
</div>
</div>





</x-app-layout>
    