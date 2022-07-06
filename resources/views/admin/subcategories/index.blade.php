<x-app-layout>
{{-- index catygories --}}


                <div class="card" dir="rtl">
                    {{-- selected category information --}}
                    <div class="card-header w-full py-2 ">
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
                                    <th>عرض</th>
                                    <th>تعديل</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                <tr>
                                    <td>{{ $subcategory->id }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>{{ substr($subcategory->description,0,10)."..." ?? '' }}</td>
                                    <td>{{ $subcategory->is_deleted ? "ملغي" : "نشط" }}</td>
                                    <td>{{ $subcategory->created_at }}</td>
                                    <td>{{ $subcategory->updated_at }}</td>
                                    <td><a href="{{ route('subcategories.show',['id' => $subcategory->id]) }}">
                                        <x-jet-button style="background-color: rgb(0, 83, 139);">عرض</x-jet-button>
                                        </a>
                                    </td>
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
                    <div class="card-footer clearfix">
                        <ul class="pagination m-0 float-right">
                            {{ $subcategories->links() }}
                        </ul>
                    </div>

                    <!-- /.card-body -->
                </div>

                <!-- /.card -->

{{-- end index catygories --}}
</x-app-layout>
