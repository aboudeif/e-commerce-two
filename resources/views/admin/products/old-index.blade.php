<x-app-layout>
  {{-- add font awsome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    {{-- add product button --}}
    <div class="flex justify-center">
        <a href="{{ route('products.create') }}" class="btn btn-add bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            إضافة منتج جديد
        </a>
    </div>
    {{-- index products for admin in Expandable Rows each row has product > product_variances --}}
    <div class="flex justify-center" dir="rtl">
        <div class="flex flex-wrap justify-center">
            @foreach($products as $product)
                <div class="w-full md:w-1/2 lg:w-1/3 p-3">
                    <div class="bg-white border rounded-lg shadow-lg">
                        <div class="px-6 py-4">
                            <div class="inline">
                                {{-- add category and subcategory as links to search here --}}
                                <div>
                                <a href="{{ route('products.index', ['category'=>$product->Subcategory->category_id]) }}">
                                    {{  $product->Subcategory->Category->name }}
                                </a>
                                <a href="{{ route('products.index', ['subcategory'=>$product->Subcategory->name]) }}">
                                    {{ "> ".$product->Subcategory->name }}
                                </a>
                                </div>
                                <a class="font-bold text-xl mb-2" href="{{ route('products.show', $product->id) }}">
                                    {{ $product->name }}
                                </a>
                            </div>
                            <div class="inline">
                                
                                    <img width="100rem" class="inline" src="{{ $product->product_media->first->media_url }}" alt="">
                       
                            </div>
                           
                         {{-- arrow to expand card using js --}}
                            <div class="flex justify-center">
                                {{-- font awsome expand --}}
                                {{-- <i class="fas fa-arrow-down"></i> --}}
                                {{-- <i class="fas fa-arrow-down" onclick="expandCard('{{ $product->id }}')"></i> --}}
                                <button class="fas fa-arrow-down" onclick="expandCard('{{ $product->id }}')">إظهار الكميات</button>
                                {{-- <button onclick="expandCard('{{ $product->id }}');" style="z-index: 100" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Sohw Quantities
                                </button> --}}
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <div id="{{ $product->id }}" class="hidden w-full md:w-1/2 lg:w-1/3 p-3" style="margin-top: -30px;">
                    <div class="bg-white border rounded-lg shadow-lg">
                        <div class="px-6 py-4">
                            <div class="inline">
                                <div class="my-3">
                                @foreach ($product->product_media as $media)
                                    <img width="100rem" class="inline" src="{{ $media->media_url }}" alt="">
                                @endforeach
                                </div>
                                <div class="shadow-sm p-1 mb-2 bg-white rounded">
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        تاريخ الإضافة
                                     </div>
                                     <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        تاريخ التعديل
                                     </div>
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        الكمية
                                     </div>
                                     <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                       الحجم
                                    </div>
                                     <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        اللون
                                    </div>
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        السعر
                                    </div>
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        الخصم
                                    </div>
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        الإجمالي
                                    </div>
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        تعديل
                                    </div>
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        حذف
                                    </div>
                                    
                                </div>
                                @foreach ($product->product_variances as $variance)
                                <div class="shadow-sm p-1 mb-2 bg-white rounded">
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        {{ $variance->created_at->format('d-m-Y') }}
                                     </div>
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        {{ $variance->updated_at->format('d-m-Y') }}
                                    </div>
                                    <div class="inline rounded-full px-3 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        {{ $variance->quantity . " قطعة"  }}
                                     </div>
                                     <div class="inline rounded-full px-3 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        {{ $variance->size }}
                                    </div>
                                     <div class="inline rounded-full px-3 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        {{ $variance->color }}
                                    </div>
                                    <div class="inline rounded-full px-3 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        {{ $variance->price . " " . "جنيه" }}
                                    </div>
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        0%
                                    </div>
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        {{ $variance->price * $variance->quantity . " " . "جنيه" }}
                                    </div>
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        <a href="{{ route('products.edit', $variance->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="inline rounded-full px-4 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                        <a href="{{ route('products.destroy', $variance->id) }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                    
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                           
                
                
            @endforeach
        </div>
    </div>
    
<div class="flex justify-center">
    {{-- dont show pagination info --}}
    @if($products->total() > 0)
    {{ $products->appends(request()->query())->links() }}
    @endif
</div>


    
<script>
    function expandCard(id) {
        var x = document.getElementById(id);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>


</x-app-layout>
