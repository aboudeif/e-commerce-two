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
                                    <th>البريد الإلكتروني</th>
                                    <th>الحالة</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>تاريخ التعديل</th>
                                    <th>عرض</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                 <tr class="cursor-pointer">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->is_deleted ? "محظور" : "نشط" }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                    <td><a href="{{ route('users.show',['id'=>$user->id]) }}">
                                        <x-jet-button style="background-color: rgb(0, 83, 139);">عرض</x-jet-button>
                                        </a>
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
                            {{ $users->links() }}
                        </ul>
                    </div>

                <!-- /.card -->

{{-- end index catygories --}}
</x-app-layout>
