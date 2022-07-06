<x-app-layout>

{{-- {{ dd($user) }} --}}

                <div class="card" dir="rtl">
 
                    <div class="card-header w-full py-2 ">
                        <h3 class="card-title inline text-center w-full bg-warning text-white px-5 rounded-2">بيانات المستخدم</h3>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">الإسم</x-jet-label>
                            <x-jet-label class="inline" value="{{ $user->name }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" >البريد الالكتروني</x-jet-label>
                            <x-jet-label class="inline" value="{{ $user->email }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline" >الحالة</x-jet-label>
                            <x-jet-label class="inline" value="{{ $user->is_deleted  ? 'ملغي' : 'نشط' }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">تاريخ الإضافة</x-jet-label>
                            <x-jet-label class="inline" value="{{ $user->created_at }}" />
                        </div>
                        <div class="my-2">
                            <x-jet-label class="rounded-2 mx-3 px-2 bg-gray-200 inline">تاريخ التعديل</x-jet-label>
                            <x-jet-label class="inline" value="{{ $user->updated_at }}"/>
                        </div>

                    </div>




                    <div class="card-header w-full ">
                        <h3 class="card-title inline float-right">طلبات الشراء</h3>
                        <a href="{{ route('subcategories.create') }}" class="float-right">
                            <x-jet-button style="background-color: darkgreen;">إضافة قسم فرعي</x-jet-button> 
                        </a>
                    </div>

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
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ substr($order->description,0,10)."..." ?? ''  }}</td>
                                    <td>{{ $order->is_deleted ? "ملغي" : "نشط" }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->updated_at }}</td>
                                    <td><a href="{{ route('subcategories.show',['id'=>$order->id]) }}">
                                        <x-jet-button style="background-color: rgb(0, 83, 139);">عرض</x-jet-button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('subcategories.edit', $order->id) }}"><x-jet-button style="background-color: rgb(0, 55, 139);">تعديل</x-jet-button></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('subcategories.destroy', $order->id) }}" method="POST">
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
                    
                </div>

        
</x-app-layout>
