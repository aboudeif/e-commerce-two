<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


<!-- add to favourites with ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script>
    function addToFavourites(product_id) {

        $.ajax({
            url: '/favourites/'+product_id+'/store',
                type: 'POST',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'product_id': product_id
                },
            success: function(data) {
                console.log(data);
                alert('Product added to favourites');
            },
            error: function(data) {
                console.log(data);
                alert('Faild or Product already added to favourites');
            }
        });
    }

</script>
{{-- content --}}
<x-app-layout>
    <x-slot name="header">
    </x-slot>

    {{-- get products from ProductController using pagination in responsive grid product cards --}}
    <div class="flex flex-wrap justify-center">
        @foreach($products as $product)
            <div style="width: 20rem" class="mx-3 my-3" loading="lazy">
                <div class="flex flex-col break-2">
                    <div class="flex-1 bg-white rounded-lg shadow-lg overflow-hidden border-b border-gray-200">
                        <div >
                            <!-- favourite heart convert to red when hover -->
                           
                                <!-- <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg> -->
                                <span id="favourite-button" onclick="addToFavourites('{{$product->id}}');" onmousemove="$(this).css('opacity', '0.8');" onmouseout="$(this).css('opacity', '1');" class="text-gray-500  position-absolute mx-4 mr-2 mt-2 cursor-pointer material-icons-outlined" style="font-family: 'Material Icons';z-index:99;" title='Add product to favorite'>favorite</span>
                            

                            <!-- favourite heart to add-to-favourites -->

                                <!-- <a onclick="addToFavourites($product->id)" id="favourite-button" class="position-absolute mx-4 mr-2 mt-2  bg-gray-600 hover:bg-red-700 w-min-content ">
                                    <span class="material-symbols-outlined py-1 color-red-700 font-bold">favorite</span>
                                </a>  -->
                            
                            <img src="{{ $product->media_url }}" alt="{{ $product->name }}" class="img-fluid"  onmousemove="$(this).css('opacity', '0.8');" onmouseout="$(this).css('opacity', '1');">
                            <div class="font-bold text-xl my-2 text-right px-3">
                                <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                            </div>
                            <p class="text-gray-700 text-right px-3">
                                {{ $product->price }} EGP
                            </p>
                        </div>
                        <div class="px-6 m-4 inline-block">
                            <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-500 mr-2" dir="rtl">{{ "#".$product->category }} </span>
                            <span class=" bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-500 mr-2" dir="rtl">{{ "#".$product->subcategory }} </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- pagination --}}
    @if(isset($products))
    <div class="flex justify-center">
        {{ $products->links() }}
    </div>
    @endif

</x-app-layout>
   <div>
        <!-- js onfoucs change color to red -->
    