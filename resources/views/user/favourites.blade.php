

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
                console.log(data);
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
    <div class="flex flex-wrap justify-center">
        @foreach($favourites as $product)
            <div style="width:16rem;" class="mx-3 my-3 product" loading="lazy">
                <div class="flex flex-col break-2">
                    <div class="flex-1 bg-white rounded-lg shadow-lg overflow-hidden border-b border-gray-200">
                        <div style="height:350px;">
                                <span 
                                    id="{{ 'v_'.$product->id }}"
                                    onclick="addToFavourites('{{ $product->id }}');" 
                                    onmousemove="$(this).css('text-shadow', '0 0 15px white');" 
                                    onmouseout="$(this).css('text-shadow', 'none');" 
                                    class=" {{ $product->favourites->first->product_id ? 'text-red-500' : 'text-white' }} position-absolute mx-4 mr-2 mt-2 cursor-pointer material-symbols-outlined user-select-none "
                                    style="font-family: 'Material Icons';z-index:11;" 
                                    title='حفظ المنتج في المفضلة أو حذفه منها'>
                                    favorite
                                </span>
   
                            <img class="product-image" src="https://lcw.akinoncdn.com/products/2022/02/28/3229144/a24a1f92-db10-4a6a-9bdc-4af4fd842ee5_size265x353_cropCenter.jpg" 
                            {{-- src="{{ $product->product_media->first()->media_url }}"  --}}
                            alt="{{ $product->name }}">
                        </div>
                        
                        <div style="z-index:30;">
                            <div class="font-bold text-xl my-2 text-right px-3">
                                <a href="{{ route('products.show', $product->id) }}">
                                    {{ $product->name }}
                                </a>
                            </div>
                            <span
                                id="{{ 'C_'.$product->id }}"
                                onclick="addToCart('{{ $product->id }}');" 
                                onmousemove="$(this).css('opacity', '0.8');" 
                                onmouseout="$(this).css('opacity', '1');" 
                                class=" {{ $product->cart ? 'text-green-500' : 'text-gray-500' }} position-absolute mx-4 my-1 cursor-pointer material-symbols-outlined user-select-none "
                                style="font-family: 'Material Icons';" 
                                title='إضافة المنتج  إلي سلة المشتريات أو حذفه منها'>
                                shopping_cart
                            </span>

                            <span>
                                <input 
                                type="number" 
                                min="0" 
                                max="100" 
                                value="0" 
                                style="margin-left: 1.5rem ;margin-left: 1rem !important;outline: 0 none;border: 0 none;text-align: center;width: 7rem;height: 2rem;cursor: pointer;color: rgb(106, 106, 106);background-color: #fff;border-radius: 0.5rem;box-shadow: 0 0.01rem .01rem rgba(0, 0, 0, 0.2);"
                                id="{{ 'N_'.$product->id }}" 
                                onchange="addToCart('{{ $product->id }}');">
                            </span>
                            
                            <div class="text-gray-700 text-right px-3">
                            
                                {{ $product->product_variances->first()->price . " " . "EGP" }}

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
    @if(isset($favourites))
    <div class="flex justify-center">
       
    </div>
    @endif

{{-- pagination --}}

<div class="flex justify-center">
    {{-- dont show pagination info --}}

    @if($favourites->total() > 0)
    {{ $favourites->appends(request()->query())->links() }}
    @endif
    
</div>




</x-app-layout>
  