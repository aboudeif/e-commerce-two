<x-app-layout>
    {{-- create new category --}}
    <div class="card mx-2 my-2" dir="rtl">
        <div class="card-header w-full">
            <h3 class="card-title inline ">إضافة قسم رئيسي</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <form action="{{ route('categories.store',['deleted'=>false]) }}" method="POST" class="mx-2 my-2">
                @csrf
                <div class="form-group">
                    <label for="catName">الإسم</label>
                    <x-jet-input type="text" class="form-control" id="catName" name="catName" placeholder="الإسم" required autofocus />
                </div>
                <div class="form-group">
                    <label for="description">الوصف</label>
                    <x-jet-input type="text" class="form-control" id="description" name="description" required autofocus />
                </div>

                <x-jet-button type="submit" class="my-2" style="background-color: darkgreen;">إضافة</x-jet-button>
            </form>
        </div>
    </div>
</x-app-layout>