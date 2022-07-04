<x-app-layout>
{{-- index catygories --}}


                <div class="card" dir="rtl">
                    {{-- selected category information --}}
                    <div class="card-header w-full py-2 ">
                        <h3 class="card-title inline text-center w-full bg-warning text-white px-5 rounded-2">بيانات التصنيف الرئيسي</h3>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" for="catName">الإسم</x-jet-label>
                            <x-jet-label class="inline" value="{{ $category->name }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" for="description">الوصف</x-jet-label>
                            <x-jet-label class="inline" value="{{ $category->description }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" for="is_deleted">الحالة</x-jet-label>
                            <x-jet-label class="inline" value="{{ $category->is_deleted  ? 'ملغي' : 'نشط' }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" for="created_at">تاريخ الإضافة</x-jet-label>
                            <x-jet-label class="inline" value="{{ $category->created_at }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" for="updated_at">تاريخ التعديل</x-jet-label>
                            <x-jet-label class="inline" value="{{ $category->updated_at }}" />
                        </div>

                    </div>
                    <!-- /.card-header -->



                    <div class="card-header w-full ">
                        <h3 class="card-title inline float-right">الأقسام الفرعية</h3>
                        <a href="{{ route('subcategories.create') }}" class="float-right">
                            <x-jet-button style="background-color: darkgreen;">إضافة قسم فرعي</x-jet-button> 
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الرقم التعريفي</th>
                                    <th>الإسم</th>
                                    <th>الوصف</th>
                                    <th>الحالة</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>تاريخ التعديل</th>
                                    <th>تعديل</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category->subcategories as $subcategory)
                                <tr>
                                    <td>{{ $subcategory->id }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>{{ $subcategory->description ?? '' }}</td>
                                    <td>{{ $subcategory->is_deleted ? "ملغي" : "نشط" }}</td>
                                    <td>{{ $subcategory->created_at }}</td>
                                    <td>{{ $subcategory->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('subcategories.edit', $subcategory->id) }}"><x-jet-button style="background-color: rgb(0, 55, 139);">تعديل</x-jet-button></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST">
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
                    {{-- <div class="card-footer clearfix">
                        <ul class="pagination m-0 float-right">
                            {{ $category->subcategories->links() }}
                        </ul>
                    </div> --}}

                    <!-- /.card-body -->
                </div>

                <!-- /.card -->

{{-- end index catygories --}}
</x-app-layout>
