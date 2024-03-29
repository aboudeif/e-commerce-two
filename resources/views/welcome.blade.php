
    <script>
    function addToFavourites(id) {

        $.ajax({
            url: '/favourites/'+id+'/store',
                type: 'POST',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'product_id': id
                },

            success: function(data) {
                var item = document.querySelector('#v_'+ data['id']);
                if(data['action'] == "add"){
                    item.classList.remove('text-white');
                    item.classList.add('text-red-500');
                }
                else{
                    item.classList.add('text-white');
                    item.classList.remove('text-red-500');
                }

            },
            error: function(data) {
                console.log(data);
                
            }
        });
    }

    // function addToCart(id) {

    //     $.ajax({
    //         url: '/cart/'+id+'/store',
    //             type: 'POST',
    //             data: {
    //             '_token': $('meta[name="csrf-token"]').attr('content'),
    //             'product_variance_id': id
    //             },

    //         success: function(data) {
    //             var item = document.querySelector('#C_'+ data['id']);
    //             if(data['action'] == "add"){
    //                 item.classList.remove('text-gray-500');
    //                 item.classList.add('text-green-500');
    //             }
    //             else{
    //                 item.classList.add('text-gray-500');
    //                 item.classList.remove('text-green-500');
    //             }

    //         },
    //         error: function(data) {
    //             console.log(data);
    //             }
    //         });
    // }




</script>
<style>
    .product
    {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 1rem;
        border: 1px solid #eaeaea;
        border-radius: .5rem;
        box-shadow: 0 0.01rem .01rem rgba(0, 0, 0, 0.2);
        transition: all .3s ease-in-out;
        cursor: pointer;
        overflow: hidden;
    }
    .product:hover
    {
        box-shadow: 0 0 0.7rem rgba(0,0,0,0.2);

    }
    /* .product-image:hover
    {
        transform: scale(1.1);
        transition: all .3s ease-in-out;
    } */
    .product-image
    {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        transition: all .2s ease-in-out;
    }
    .product-info
    {
        padding: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    
    .category
    {
        font-size: .8rem;
        margin: 1px;
        padding: 0;
    }
    </style>
{{-- content --}}
<x-app-layout>
    <x-slot name="header">
    </x-slot>

    {{-- get products from ProductController using pagination in responsive grid product cards --}}
    <div class="flex flex-wrap justify-center mb-20">
        
        @foreach($products as $product)
        {{-- {{ dd(Auth::user()->id) }} --}}
            <div style="width:16rem;" class="mx-3 my-3 product" loading="lazy">
                <div class="flex flex-col break-2">
                    <div class="flex-1 bg-white rounded-lg shadow-lg overflow-hidden border-b border-gray-200">
                        <div style="height:350px;">
                            @auth
                                <span 
                                    id="{{ 'v_'.$product->id }}"
                                    onclick="addToFavourites('{{ $product->id }}');" 
                                    onmousemove="$(this).css('text-shadow', '0 0 15px white');" 
                                    onmouseout="$(this).css('text-shadow', 'none');" 
                                    {{ $color="text-white" }}

                                    
                                        
                                        @if(isset($product->favourites->first->user_id->user_id) &&
                                         Auth::user()->id == $product->favourites->first->user_id->user_id)
                                            {{ $color="text-red-500" }}
                                        @endif

                                        class="{{ $color}} position-absolute mx-4 mr-2 mt-2 cursor-pointer material-symbols-outlined user-select-none"
                                
                                    style="font-family: 'Material Icons';z-index:11;" 
                                    title='حفظ المنتج في المفضلة أو حذفه منها'>
                                    favorite
                                </span>
                            @endauth
   
                            <img class="product-image" src="https://lcw.akinoncdn.com/products/2022/02/28/3229144/a24a1f92-db10-4a6a-9bdc-4af4fd842ee5_size265x353_cropCenter.jpg" 
       
                            alt="{{ $product->name }}">
                        </div>
                        
                        <div style="z-index:30;">
                            <div class="font-bold text-xl my-2 text-right px-3">
                                <a href="{{ route('products.show', ['id'=>$product->id]) }}">
                                    {{ $product->name }}
                                </a>
                            </div>

                            <div class="text-gray-700 text-right px-3">
                            
                                {{ $product->price . " " . "EGP" }}

                            </div>
                            <div class="px-6 m-4 inline-block w-full">
                                <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                        
                                    <a href="{{ route('products.index', ['category'=>$product->Subcategory->category_id]) }}">
                                    {{ "#". $product->Subcategory->Category->name }} 
                                    </a>
                                </span>
                                <span class=" bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-500 mr-2 category" dir="rtl">
                                    <a href="{{ route('products.index', ['subcategory'=>$product->Subcategory->name]) }}">
                                    {{ "#".$product->Subcategory->name }} 
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- pagination --}}
    @if(isset($products))
    <div class="flex justify-center">
       
    </div>
    @endif

{{-- pagination --}}

<div class="flex justify-center">
    {{-- dont show pagination info --}}

    @if($products->total() > 0)
    {{ $products->appends(request()->query())->links() }}
    @endif
    
</div>

</x-app-layout>
  

    