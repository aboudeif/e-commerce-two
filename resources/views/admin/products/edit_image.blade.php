<x-app-layout>
    {{-- create new subcategory --}}
    <div class="card mx-2 my-2" dir="rtl">
        <div class="card-header w-full">
            <h3 class="card-title inline ">تعديل المنتج</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <form action="{{ route('products.update',['id'=>$product->id]) }}" method="POST" class="mx-2 my-2">
                @csrf
                {{-- ajax code to get all categories names --}}

                <div class="form-group">
                    <label class="my-2" for="prodSubcat">التصنيف الفرعي</label>
                    <select class="form-control" id="prodSubcat" name="prodSubcat" required>
                    
                    </select>
                </div>
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: "{{ route('subcategories.api') }}",
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $.each(data, function(key, value) {
                                    $('#prodSubcat').append(
                                        '<option value="' + value.id + '">' + value.name + '</option>'
                                    );
                                });
                                $('#prodSubcat').val({{ $product->subcategory_id }});
                            }
                        });
                    });
                </script>
                <div class="form-group">
                    <label class="my-2" for="subcatId">الرقم التعريفي</label>
                    <x-jet-input type="text" value="{{ $product->id }}" class="form-control" id="prodId" name="prodId" placeholder="0" readonly autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="prodName">الإسم</label>
                    <x-jet-input type="text" value="{{ $product->name }}" class="form-control" id="prodName" name="prodName" placeholder="الإسم" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="prodName">السعر</label>
                    <x-jet-input type="text" value="{{ $product->price }}" class="form-control" id="prodPrice" name="prodPrice" placeholder="السعر" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="prodName">الخصم</label>
                    <x-jet-input type="text" value="{{ $product->discount }}" class="form-control" id="prodDiscount" name="prodDiscount" placeholder="الخصم" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="prodDescription">الوصف</label>
                    <x-jet-input type="text" value="{{ $product->description ?? '' }}" class="form-control" id="prodDescription" name="prodDescription" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="prodIs_deleted">الحالة</label>
                    <select class="form-control" class="form-control" id="prodIs_deleted" name="prodIs_deleted" placeholder="نشط" autofocus >
                        <option value="0">نشط</option>
                        <option value="1">ملغي</option>
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label class="my-2" for="prodImage">الصورة</label>
                    <img src="{{ $image->media_url }}" class="img-thumbnail inline" width="100" height="100">
                    <x-jet-input type="file" class="form-control" id="prodImage" name="prodImage" placeholder="الصورة" autofocus />
                </div> --}}
                <script>
                    $(document).ready(function() {
                        $('#prodIs_deleted').val({{ $product->is_deleted ? '1' : '0' }});
                    });
                </script>
                <div class="form-group">
                    <label class="my-2" for="prodCreated_at">تاريخ الإنشاء</label>
                    <x-jet-input type="text" value="{{ $product->created_at }}" class="form-control" id="prodCreated_at" placeholder="0000-00-00 00-00-00" disabled autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="prodUpdated_at">تاريخ التعديل</label>
                    <x-jet-input type="text" value="{{ $product->updated_at }}" class="form-control" id="prodUpdated_at" placeholder="0000-00-00 00-00-00" disabled autofocus />
                </div>

                <x-jet-button type="submit" class="my-2" style="background-color: darkgreen;">تعديل</x-jet-button>
            </form>
        </div>
    </div>
</x-app-layout>