<x-app-layout>
    {{-- create new subcategory --}}
    <div class="card mx-2 my-2" dir="rtl">
        <div class="card-header w-full">
            <h3 class="card-title inline ">تعديل تصنيف فرعي</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <form action="{{ route('subcategories.update') }}" method="POST" class="mx-2 my-2">
                @csrf
                {{-- ajax code to get all categories names --}}

                <div class="form-group">
                    <label class="my-2" for="subcatCat">التصنيف الرئيسي</label>
                    <select class="form-control" id="subcatCat" name="subcatCat" required>
                    
                    </select>
                </div>
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: "{{ route('categories.api') }}",
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $.each(data, function(key, value) {
                                    $('#subcatCat').append(
                                        '<option value="' + value.id + '">' + value.name + '</option>'
                                    );
                                });
                                $('#subcatCat').val({{ $subcategory->category_id }});
                            }
                        });
                    });
                </script>
                <div class="form-group">
                    <label class="my-2" for="subcatId">الرقم التعريفي</label>
                    <x-jet-input type="text" value="{{ $subcategory->id }}" class="form-control" id="subcatId" name="subcatId" placeholder="0" readonly autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="subcatName">الإسم</label>
                    <x-jet-input type="text" value="{{ $subcategory->name }}" class="form-control" id="subcatName" name="subcatName" placeholder="الإسم" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="subcatDescription">الوصف</label>
                    <x-jet-input type="text" value="{{ $subcategory->description ?? '' }}" class="form-control" id="subcatDescription" name="subcatDescription" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="subcatIs_deleted">الحالة</label>
                    <select class="form-control" class="form-control" id="subcatIs_deleted" name="subcatIs_deleted" placeholder="نشط" autofocus >
                        <option value="0">نشط</option>
                        <option value="1">ملغي</option>
                    </select>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#subcatIs_deleted').val({{ $subcategory->is_deleted ? '1' : '0' }});
                    });
                </script>
                <div class="form-group">
                    <label class="my-2" for="subcatCreated_at">تاريخ الإنشاء</label>
                    <x-jet-input type="text" value="{{ $subcategory->created_at }}" class="form-control" id="subcatCreated_at" placeholder="0000-00-00 00-00-00" disabled autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="subcatUpdated_at">تاريخ التعديل</label>
                    <x-jet-input type="text" value="{{ $subcategory->updated_at }}" class="form-control" id="subcatUpdated_at" placeholder="0000-00-00 00-00-00" disabled autofocus />
                </div>

                <x-jet-button type="submit" class="my-2" style="background-color: darkgreen;">تعديل</x-jet-button>
            </form>
        </div>
    </div>
</x-app-layout>