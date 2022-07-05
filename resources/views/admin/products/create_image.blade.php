<x-app-layout>
    {{-- create new subcategory --}}
    <div class="card mx-2 my-2" dir="rtl">
        <div class="card-header w-full">
            <h3 class="card-title inline ">إضافة كمية جديدة لمنتج</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <form action="{{ route('variances.store') }}" method="POST" class="mx-2 my-2">
                @csrf
                
                
                <div class="form-group">
                    <label class="my-2" for="prodName">الإسم</label>
                    <x-jet-input type="text" class="form-control" id="prodName" name="prodName" placeholder="الإسم" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="prodName">السعر</label>
                    <x-jet-input type="text" class="form-control" id="prodPrice" name="prodPrice" placeholder="السعر" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="prodName">الخصم</label>
                    <x-jet-input type="text" class="form-control" id="prodDiscount" name="prodDiscount" placeholder="الخصم" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="prodDescription">الوصف</label>
                    <x-jet-input type="text" class="form-control" id="prodDescription" name="prodDescription" required autofocus />
                </div>
                <div class="form-group">
                    <label class="my-2" for="prodIs_deleted">الحالة</label>
                    <select class="form-control" class="form-control" id="prodIs_deleted" name="prodIs_deleted" placeholder="نشط" autofocus >
                        <option value="0">نشط</option>
                        <option value="1">ملغي</option>
                    </select>
                </div>
                
                <x-jet-button type="submit" class="my-2" style="background-color: darkgreen;">إنشاء</x-jet-button>
            </form>
        </div>
    </div>
</x-app-layout>