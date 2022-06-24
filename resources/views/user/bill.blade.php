{{-- <style>
    .parent {
display: grid;
grid-template-columns: repeat(4, 1fr);
grid-template-rows: repeat(6, 1fr);
grid-column-gap: 0px;
grid-row-gap: 0px;

}

.div1 { grid-area: 1 / 3 / 2 / 5; }
.div2 { grid-area: 1 / 1 / 2 / 3; }
.div3 { grid-area: 2 / 3 / 3 / 5; }
.div4 { grid-area: 2 / 1 / 3 / 3; }
.div5 { grid-area: 3 / 1 / 4 / 5; }
.div6 { grid-area: 4 / 1 / 5 / 5; }
.div7 { grid-area: 5 / 1 / 6 / 5; }
.div8 { grid-area: 6 / 1 / 7 / 5; }
</style> --}}
<x-app-layout>
    {{-- php dummy values for each variable in page --}}
    <?php $customer = (object)[
        'name' => 'محمد',
        'phone' => '0123456789',
        'email' => 'knkojl@jijo.com',
        'address' => 'الرياض',
        'city' => 'الرياض',
        'postal_code' => '12345',
        'bill_number' => '12345',
        'amount' => '100',
        'id' => '1',
        'bill_created_at' => '2020-01-01',
        'bill_updated_at' => '2020-01-01',
        'bill_date' => '2020-01-01',
        'bill_note' => 'note',
        'bill_total' => '100',
        'bill_status' => 'paid',
        'bill_payment_method' => 'cash',
        'bill_items' => (object)[
            (object)[
                'item_name' => 'item name',
                'item_price' => '100',
                'item_quantity' => '1',
                'item_total' => '100',
            ],
            (object)[
                'item_name' => 'item name',
                'item_price' => '100',
                'item_quantity' => '1',
                'item_total' => '100',
            ],
        ],

    ]; ?>

    {{-- a line to show e-commerce order stage  --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('E-Commerce Order Stage') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- customer final bill with products prices and tax and dates ,... --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-chart-bar text-gray-400 mr-1"></i>
            {{ __('Bill') }}
        </h2>
    </x-slot>
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="parent bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" dir="rtl">
                <div class="div2 flex flex-fill  -mx-3 mb-6">
                    <div class=" px-3">
                        <label class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            {{ __('رقم الفاتورة') }}
                        </label>
                        <input
                            class="appearance-none inline-block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-1/2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-first-name"
                            type="text"
                            placeholder="{{ __('رقم الفاتورة') }}"
                            value="{{ $customer->bill_number }}"
                            readonly
                        >
                    </div>
                    <div class=" px-3">
                        <label class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            {{ __('تاريخ الفاتورة') }}
                        </label>
                        <input
                            class="appearance-none inline-block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-1/2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-first-name"
                            type="text"
                            placeholder="{{ __('تاريخ الفاتورة') }}"
                            value="{{ $customer->bill_date }}"
                            readonly
                        >
                    </div>
                </div>
                <div class="div5 flex flex-fill align-content-start -mx-3 mb-6">
                    <div class="px-3">
                        <label class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            {{ __('اسم العميل') }}
                        </label>
                        <input
                            class="appearance-none inline-block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-1/2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-first-name"
                            type="text"
                            placeholder="{{ __('اسم العميل') }}"
                            value="{{ $customer->name }}"
                            readonly
                        >
                    </div>
                </div>
                <div class="div3 flex flex-fill  -mx-3 mb-6">
                    <div class=" px-3">
                        <label class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            {{ __('الهاتف') }}
                        </label>
                        <input
                            class="appearance-none inline-block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-1/2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-first-name"
                            type="text"
                            placeholder="{{ __('الهاتف') }}"
                            value="{{ $customer->phone }}"
                            readonly
                        >
                    </div>
                    <div class=" px-3">
                        <label class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            {{ __('البريد الإلكتروني') }}
                        </label>
                        <input
                            class="appearance-none inline-block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-1/2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-first-name"
                            type="text"
                            placeholder="{{ __('البريد الإلكتروني') }}"
                            value="{{ $customer->email }}"
                            readonly
                        >
                    </div>
                </div>
                <div class="div6 flex flex-fill  -mx-3 mb-6">
                    <div class=" px-3">
                        <label class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            {{ __('عنوان العميل') }}
                        </label>
                        <input
                            class="appearance-none inline-block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-1/2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-first-name"
                            type="text"
                            placeholder="{{ __('عنوان العميل') }}"
                            value="{{ $customer->address }}"
                            readonly
                        >
                    </div>
                </div>
                
                
                
                {{-- <div class="flex flex-fill  -mx-3 mb-6">
                    <div class=" px-3">
                        <label class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            {{ __('Customer Bill Total') }}
                        </label>
                        <input
                            class="appearance-none inline-block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-1/2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-first-name"
                            type="text"
                            placeholder="{{ __('Customer Bill Total') }}"
                            value="{{ $customer->bill_total }}"
                            readonly
                        >
                    </div>
                </div> --}}
                {{-- <div class="flex flex-fill  -mx-3 mb-6">
                    <div class=" px-3">
                        <label class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            {{ __('Customer Bill Status') }}
                        </label>
                        <input
                            class="appearance-none inline-block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-1/2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-first-name"
                            type="text"
                            placeholder="{{ __('Customer Bill Status') }}"
                            value="{{ $customer->bill_status }}"
                            readonly
                        >
                    </div>
                </div> --}}
                <div class="div7 flex flex-fill  -mx-3 mb-6">
                    <div class=" px-3">
                        <label class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            {{ __('Customer Bill Note') }}
                        </label>
                        <input
                            class="appearance-none inline-block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-1/2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-first-name"
                            type="text"
                            placeholder="{{ __('Customer Bill Note') }}"
                            value="{{ $customer->bill_note }}"
                            readonly
                        >
                    </div>
                </div>
                {{-- <div class="flex flex-fill  -mx-3 mb-6">
                    <div class=" px-3">
                        <label class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            {{ __('Customer Bill Created At') }}
                        </label>
                        <input
                            class="appearance-none inline-block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-1/2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-first-name"
                            type="text"
                            placeholder="{{ __('Customer Bill Created At') }}"
                            value="{{ $customer->bill_created_at }}"
                            readonly
                        >
                    </div>
                </div> --}}
                {{-- <div class="flex flex-fill  -mx-3 mb-6">
                    <div class=" px-3">
                        <label class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            {{ __('Customer Bill Updated At') }}
                        </label>
                        <input
                            class="appearance-none inline-block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-1/2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-first-name"
                            type="text"
                            placeholder="{{ __('Customer Bill Updated At') }}"
                            value="{{ $customer->bill_updated_at }}"
                            readonly
                        >
                    </div>
                </div> --}}
                

                <div class="flex flex-fill  -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            {{ __('Customer Bill Items') }}
                        </label>
                        <div class="flex flex-fill  -mx-3 mb-6">
                            <div class="w-full px-3">
                                <table class="table-auto">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2">{{ __('اسم المنتج') }}</th>
                                            <th class="px-4 py-2">{{ __('الكمية') }}</th>
                                            <th class="px-4 py-2">{{ __('السعر') }}</th>
                                            <th class="px-4 py-2">{{ __('المجموع') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer->bill_items as $item)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $item->item_name }}</td>
                                                <td class="border px-4 py-2">{{ $item->item_quantity }}</td>
                                                <td class="border px-4 py-2">{{ $item->item_price }}</td>
                                                <td class="border px-4 py-2">{{ $item->item_total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- buttons to download as pdf and print --}}
                <div class="flex flex-fill  -mx-3 mb-6">
                    <div class="w-full px-3">
                        {{-- <a href="{{ route('customer.bill.pdf', $customer->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Download as PDF') }}
                        </a>
                        <a href="{{ route('customer.bill.print', $customer->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Print') }}
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
</x-app-layout>