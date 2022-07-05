<x-app-layout>
    {{-- create new subcategory --}}
    <div class="card mx-2 my-2" dir="rtl">
        <div class="card-header w-full">
            <h3 class="card-title inline ">إنشاء تصنيف فرعي</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <form action="{{ route('subcategories.store') }}" method="POST" class="mx-2 my-2">
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
                                
                            }
                        });
                    });
                </script>
                
                <div class="form-group">
                    <label class="my-2" for="subcatName">الإسم</label>
                    <x-jet-input type="text" class="form-control" id="subcatName" name="subcatName" placeholder="الإسم" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="subcatDescription">الوصف</label>
                    <x-jet-input type="text" class="form-control" id="subcatDescription" name="subcatDescription" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="subcatIs_deleted">الحالة</label>
                    <select class="form-control" class="form-control" id="subcatIs_deleted" name="subcatIs_deleted" placeholder="نشط" autofocus >
                        <option value="0">نشط</option>
                        <option value="1">ملغي</option>
                    </select>
                </div>
                
               

                <x-jet-button type="submit" class="my-2" style="background-color: darkgreen;">إنشاء</x-jet-button>
            </form>
        </div>
    </div>
</x-app-layout>