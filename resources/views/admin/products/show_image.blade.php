<x-app-layout>
{{-- index catygories --}}


                <div class="card" dir="rtl">
                    {{-- selected category information --}}
                    <div class="card-header w-full py-2 ">
                        <h3 class="card-title inline text-center w-full bg-warning text-white px-5 rounded-2">بيانات المنتج</h3>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الرقم التعريفي</x-jet-label>
                            <x-jet-label class="inline" value="{{ $product->id }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" >الإسم</x-jet-label>
                            <x-jet-label class="inline" value="{{ $product->name }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" >السعر</x-jet-label>
                            <x-jet-label class="inline" value="{{ $product->price }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" >الخصم</x-jet-label>
                            <x-jet-label class="inline" value="{{ $product->discount }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" >التصنيف الفرعي</x-jet-label>
                            <x-jet-label class="inline" value="{{ $subcategory_name }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الوصف</x-jet-label>
                            <x-jet-label class="inline" value="{{ $product->description }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الحالة</x-jet-label>
                            <x-jet-label class="inline" value="{{ $product->is_deleted  ? 'محذوف' : 'نشط' }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">تاريخ الإضافة</x-jet-label>
                            <x-jet-label class="inline" value="{{ $product->created_at }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">تاريخ التعديل</x-jet-label>
                            <x-jet-label class="inline" value="{{ $product->updated_at }}" />
                        </div>
                        {{-- images in slidable bar --}}
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الصور</x-jet-label>
                            @foreach ($product->images as $image)
                                {{-- <img src="- asset('storage/' . $image->path) -" class="img-thumbnail" width="100" height="100"> --}}
                                <img src="{{ $image->media_url }}" class="img-thumbnail inline" width="100" height="100">
                                
                            @endforeach
                            <a href="{{ route('media.create',['id', $product->id]) }}" class="float-right">
                                <x-jet-button style="background-color: darkgreen;" class="material-symbols-outlined">add_circle</x-jet-button> 
                            </a>
                        </div>


                    </div>
                    <!-- /.card-header -->



                    <div class="card-header w-full ">
                        <h3 class="card-title inline float-right">الكميات</h3>
                        <a href="{{ route('variances.create',['id', $product->id]) }}" class="float-right">
                            <x-jet-button style="background-color: darkgreen;">إضافة كمية للمنتج</x-jet-button> 
                        </a>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الرقم التعريفي</th>
                                    <th>الكمية</th>
                                    <th>النقاط</th>
                                    <th>اللون</th>
                                    <th>كود اللون</th>
                                    <th>المقاس</th>
                                    <th>الحالة</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>تاريخ التعديل</th>
                                    
                                    <th>تعديل</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($variances as $variance)
                                <tr>
                                    <td>{{ $variance->id }}</td>
                                    <td>{{ $variance->quantity }}</td>
                                    <td>{{ $variance->points }}</td>
                                    <td>{{ $variance->color }}</td>
                                    <td>{{ $variance->color_code }}</td>
                                    <td>{{ $variance->size }}</td>
                                    <td>{{ $variance->is_deleted ? "ملغي" : "نشط" }}</td>
                                    <td>{{ $variance->created_at }}</td>
                                    <td>{{ $variance->updated_at }}</td>
                                    
                                    <td>
                                        <a href="{{ route('variances.edit', $variance->id) }}">
                                            <x-jet-button style="background-color: rgb(0, 55, 139);">تعديل</x-jet-button>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('variances.destroy', $variance->id) }}" method="Post">
                                            @csrf
                                            @method('DELETE')
                                            <x-jet-button style="background-color: rgb(255, 0, 0);">حذف</x-jet-button> 
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- links --}}
                   
                   
                    <div class="card-footer clearfix">
                        <ul class="pagination m-0 float-right">
                            {{ $variances->links() }}
                        </ul>
                    </div>
                    
                    <!-- /.card-body -->
                </div>

                <!-- /.card -->

{{-- end index catygories --}}
</x-app-layout>
