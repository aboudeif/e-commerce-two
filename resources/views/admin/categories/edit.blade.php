<x-app-layout>
    {{-- create new category --}}
    <div class="card mx-2 my-2" dir="rtl">
        <div class="card-header w-full">
            <h3 class="card-title inline ">تعديل تصنيف رئيسي</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <form action="{{ route('categories.update') }}" method="POST" class="mx-2 my-2">
                @csrf
                <div class="form-group">
                    <label class="my-2" for="catId">الرقم التعريفي</label>
                    <x-jet-input type="text" value="{{ $category->id }}" class="form-control" id="catId" name="catId" placeholder="0" readonly autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="catName">الإسم</label>
                    <x-jet-input type="text" value="{{ $category->name }}" class="form-control" id="catName" name="catName" placeholder="الإسم" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="catDescription">الوصف</label>
                    <x-jet-input type="text" value="{{ $category->description ?? '' }}" class="form-control" id="catDescription" name="catDescription" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="catIs_deleted">الحالة</label>
                    <select type="text" class="form-control" id="catIs_deleted" name="catIs_deleted" placeholder="نشط" autofocus >
                        <option value="0">نشط</option>
                        <option value="1">ملغي</option>
                    </select>
                    <script>
                        $(document).ready(function() {
                            $('#catIs_deleted').val({{ $category->is_deleted ? '1' : '0' }});
                        });
                    </script>
                </div>
                <div class="form-group">
                    <label class="my-2" for="catCreated_at">تاريخ الإنشاء</label>
                    <x-jet-input type="text" value="{{ $category->created_at }}" class="form-control" id="catCreated_at" placeholder="0000-00-00 00-00-00" disabled autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="catUpdated_at">تاريخ التعديل</label>
                    <x-jet-input type="text" value="{{ $category->updated_at }}" class="form-control" id="catUpdated_at" placeholder="0000-00-00 00-00-00" disabled autofocus />
                </div>

                <x-jet-button type="submit" class="my-2" style="background-color: darkgreen;">تعديل</x-jet-button>
            </form>
        </div>
    </div>
</x-app-layout>