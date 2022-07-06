<x-app-layout>
{{-- index catygories --}}


                <div class="card" dir="rtl">
                    {{-- selected category information --}}
                    <div class="card-header w-full py-2 ">
                        <h3 class="card-title inline text-center w-full bg-warning text-white px-5 rounded-2">إضافة منتج للتصنيف الفرعي</h3>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الرقم التعريفي</x-jet-label>
                            <x-jet-label class="inline" value="{{ $subcategory->id }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" >الإسم</x-jet-label>
                            <x-jet-label class="inline" value="{{ $subcategory->name }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" >التصنيف الرئيسي</x-jet-label>
                            <x-jet-label class="inline" value="{{ $subcategory->category_name }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الوصف</x-jet-label>
                            <x-jet-label class="inline" value="{{ $subcategory->description }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الحالة</x-jet-label>
                            <x-jet-label class="inline" value="{{ $subcategory->is_deleted  ? 'محذوف' : 'نشط' }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">تاريخ الإضافة</x-jet-label>
                            <x-jet-label class="inline" value="{{ $subcategory->created_at }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">تاريخ التعديل</x-jet-label>
                            <x-jet-label class="inline" value="{{ $subcategory->updated_at }}" />
                        </div>

                    </div>
                    <!-- /.card-header -->



                    
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الرقم التعريفي</th>
                                    <th>الإسم</th>
                                    <th>السعر</th>
                                    <th>الخصم</th>
                                    <th>الوصف</th>
                                    <th>الحالة</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>تاريخ التعديل</th>
                                    <th>إضافة</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->discount }}</td>
                                    <td>{{ substr($product->description,0,10)."..." ?? '' }}</td>
                                    <td>{{ $product->is_deleted ? "ملغي" : "نشط" }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                    <td>
                                        @if($product->subcategory_id == $subcategory->id)
                                            <x-jet-button style="background-color: darkgreen;" disabled>مضاف</x-jet-button>
                                        @else
                                        <a href="{{ route('subcategories.link',['product_id'=>$product->id,'id'=>$subcategory->id]) }}">
                                            <x-jet-button style="background-color: darkgreen;">إضافة</x-jet-button>
                                        </a>
                                        @endif
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- links --}}
                    @isset($subcategory->links)
                   
                    <div class="card-footer clearfix">
                        <ul class="pagination m-0 float-right">
                            {{ $subcategory->links() }}
                        </ul>
                    </div>
                    @endisset
                    <!-- /.card-body -->
                </div>

                <!-- /.card -->

{{-- end index catygories --}}
</x-app-layout>
