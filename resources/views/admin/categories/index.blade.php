<x-app-layout>
{{-- index catygories --}}


                <div class="card" dir="rtl">
                    <div class="card-header w-full">
                        <h3 class="card-title inline ">الأقسام الرئيسية</h3>

                        <a href="{{ route('categories.create') }}" class="float-right">
                            <x-jet-button style="background-color: darkgreen;">إضافة قسم رئيسي</x-jet-button> 
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
                                @foreach ($categories as $category)
                                 <tr class="cursor-pointer">
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ substr($category->description,0,10)."..." ?? '' }}</td>
                                    <td>{{ $category->is_deleted ? "ملغي" : "نشط" }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->updated_at }}</td>
                                    <td><a href="{{ route('categories.show',['id'=>$category->id]) }}">
                                        <x-jet-button style="background-color: rgb(0, 83, 139);">عرض</x-jet-button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}">
                                        <x-jet-button style="background-color: rgb(0, 55, 139);">تعديل</x-jet-button>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
                    <!-- /.card-body -->
                    {{-- links --}}
                    <div class="card-footer clearfix">
                        <ul class="pagination m-0 float-right">
                            {{ $categories->links() }}
                        </ul>
                    </div>

                <!-- /.card -->

{{-- end index catygories --}}
</x-app-layout>
