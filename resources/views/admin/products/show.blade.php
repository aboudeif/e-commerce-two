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
                <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الإسم</x-jet-label>
                <x-jet-label class="inline" value="{{ $product->name }}" />
            </div>
            <div class="my-2">
                <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">السعر</x-jet-label>
                <x-jet-label class="inline" value="{{ $product->price }}" />
            </div>
            <div class="my-2">
                <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الخصم</x-jet-label>
                <x-jet-label class="inline" value="{{ $product->discount }}" />
            </div>
            <div class="my-2">
                <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">التصنيف الفرعي</x-jet-label>
                <x-jet-label class="inline" value="{{ $subcategory_name }}" />
            </div>
            <div class="my-2">
                <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الوصف</x-jet-label>
                <x-jet-label class="inline" value="{{ $product->description }}" />
            </div>
            <div class="my-2">
                <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الحالة</x-jet-label>
                <x-jet-label class="inline" value="{{ $product->is_deleted ? 'محذوف' : 'نشط' }}" />
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
                    <div class="inline">
                        <span id="I_{{ $image->id }}" class="text-danger absolute cursor-pointer text-center"
                            onclick="deleteImage(this);" style="font-size: 16pt; z-index:200;">
                            &times;
                        </span>

                        <img src="{{ $image->media_url }}"
                            onmouseover="this.style.cursor='pointer'; 
                                 this.style.opacity='0.5';
                                 this.style.transition='all 0.5s ease-in-out';
                                 this.style.transform='scale(1.1)';"
                            onmouseout="this.style.opacity='1';
                                    this.style.transform='scale(1)';"
                            class="img-thumbnail inline" width="100" height="100">

                    </div>
                @endforeach

                <x-jet-button style="background-color: darkgreen;" class="material-symbols-outlined"
                    onclick="showAddImageModal();">
                    add_circle
                </x-jet-button>

                <div id="image" class="w-full rounded-0.5 mx-3 my-2" style="display: none;">
                    <form id="image_form" action="{{ route('media.store', ['id' => $product->id]) }}"
                        onsubmit="document.querySelector('#image').css('display', 'none');" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="image" class="">
                        <x-jet-button type="submit">إضافة صورة</x-jet-button>
                    </form>
                </div>


            </div>
            <script>
                function showAddImageModal() {
                    document.querySelector('#image').style.display = 'block';
                }

                function deleteImage(el) {


                    const id_num = el.id.split('_')[1];
                    var xhr = new XMLHttpRequest();

                    xhr.open('DELETE', '{{ route('media.destroy', ['id' => 'id_num']) }}'.replace("id_num", id_num));
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            el.nextElementSibling.remove();
                        }
                    };
                    xhr.send();
                }
            </script>


        </div>
        <!-- /.card-header -->



        <div class="card-header w-full ">
            <h3 class="card-title inline float-right">الكميات</h3>

            <x-jet-button onclick="showAddQuantity();" style="background-color: darkgreen;">
                إضافة كمية للمنتج
            </x-jet-button>

            <div id="quantity" class="w-full rounded-0.5 mx-3 my-2" style="display: none;">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>الكمية</th>
                            <th>النقاط</th>
                            <th>اللون</th>
                            <th>كود اللون</th>
                            <th>المقاس</th>
                            <th>الحالة</th>
                            <th>حفظ</th>
                            <th>إلغاء</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <form id="quantity_form"
                                action="{{ route('variances.store', ['product_id' => $product->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <td>
                                    <input type="number" min="1" max="1000" name="variance_quantity"
                                        placeholder="Enter product quantity" required autofocus />
                                </td>
                                <td>
                                    <input type="number" min="1" max="1000" name="variance_points"
                                        placeholder="Enter product points" required autofocus />
                                </td>
                                <td>
                                    <input type="text" name="variance_color" placeholder="Enter product color"
                                        required autofocus />
                                </td>
                                <td>
                                    <input type="color" name="variance_color_code" placeholder="Pick product color">
                                </td>

                                <td>
                                    <select name="variance_size" id="">
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="variance_is_deleted">
                                        <option value="0">نشط</option>
                                        <option value="1">ملغي</option>
                                    </select>
                                </td>
                                <td>

                                    <x-jet-button style="background-color: darkgreen;" onclick="storeQuantity();">
                                        حفظ
                                    </x-jet-button>

                                </td>
                                <td>
                                    <x-jet-button style="background-color: red;" onclick="cancelQuantity();">
                                        إلغاء
                                    </x-jet-button>
                                </td>
                            </form>
                        </tr>

                    </tbody>
                </table>

            </div>
            <script>
                function showAddQuantity() {
                    document.querySelector('#quantity').style.display = 'block';
                }

                function cancelQuantity() {
                    document.querySelector('#quantity').style.display = 'none';
                }

                function storeQuantity() {
                    document.querySelector('#quantity_form').submit();
                }
            </script>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover" id="variances_table">
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
                            <td>{{ $variance->is_deleted ? 'ملغي' : 'نشط' }}</td>
                            <td>{{ $variance->created_at }}</td>
                            <td>{{ $variance->updated_at }}</td>

                            <td class="control-button">

                                <x-jet-button onclick="showEditQuantitys('quantity_edit_{{ $variance->id }}');"
                                    style="background-color: rgb(0, 55, 139);">تعديل</x-jet-button>

                            </td>
                            <td class="control-button">
                                <form action="{{ route('variances.destroy', $variance->id) }}" method="Post">
                                    @csrf
                                    @method('DELETE')
                                    <x-jet-button style="background-color: rgb(255, 0, 0);">حذف</x-jet-button>
                                </form>
                            </td>
                        </tr>





                        <tr id="quantity_edit_{{ $variance->id }}" class="quantity_edit">

                            <td>الرقم التعريفي:
                                <input type="number"
                                    value="{{ $variance->id }}" disabled />
                            </td>

                            <td>الكمية:
                                <input type="number" min="1" max="1000" name="variances_quantity"
                                    form="quantity_form_{{ $variance->id }}" value="{{ $variance->quantity }}"
                                    required autofocus />
                            </td>
                            <td>النقاط:
                                <input type="number" min="1" max="1000" name="variances_points"
                                    form="quantity_form_{{ $variance->id }}" value="{{ $variance->points }}"
                                    required autofocus />
                            </td>
                            <td>اللون:
                                <input type="text" name="variances_color" value="{{ $variance->color }}"
                                    form="quantity_form_{{ $variance->id }}" required autofocus />
                            </td>
                            <td>كود:
                                <input type="color" name="variances_color_code"
                                    form="quantity_form_{{ $variance->id }}"
                                    value="{{ $variance->color_code }}">
                            </td>

                            <td>المقاس:
                                <select name="variances_size" value="{{ $variance->size }}"
                                    form="quantity_form_{{ $variance->id }}">
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </td>
                            <td>الحالة:
                                <select name="variances_is_deleted" value="{{ $variance->is_deleted }}"
                                    form="quantity_form_{{ $variance->id }}">
                                    <option value="0">نشط</option>
                                    <option value="1">ملغي</option>
                                </select>
                            </td>
                            <td>تاريخ الإنشاء: 
                                <input type="text"
                                    value="{{ $variance->created_at }}" class="bg-gray-200" disabled />
                            </td>
                            <td>تاريخ التعديل: 
                                <input type="text"
                                    value="{{ $variance->updated_at }}" class="bg-gray-200" disabled />
                            </td>
                            <td>

                                <x-jet-button style="background-color: darkgreen;"
                                    form="quantity_form_{{ $variance->id }}" class="mt-4" type="submit">
                                    حفظ
                                </x-jet-button>
                            </td>
                            <td>

                                <x-jet-button style="background-color: red;" type="button"
                                    onclick="cancelQuantitys('quantity_edit_{{ $variance->id }}');" class="mt-4">
                                    إلغاء
                                </x-jet-button>
                            </td>
                        </tr>
                        <form id="quantity_form_{{ $variance->id }}" class="w-full"
                            action="{{ route('variances.update', ['id' => $variance->id]) }}" method="POST">
                            @csrf
                        </form>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- links --}}
        <script>
            $('.quantity_edit').css('display','none');
            function showEditQuantitys(id) {
                $('#' + id).css('display','block');
                // $('.control-button').css('visability','hidden');

            }

            function cancelQuantitys(id) {
                $('#' + id).css('display','none');
                // $('.control-button').css('display','block');
            }
        </script>

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
