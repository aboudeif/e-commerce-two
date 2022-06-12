<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


<!-- add to favourites with ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    function addToFavourites(id) {
        
        $.ajax({
            type: 'POST',
            url: "{{ route('favourites.store',['product_id'=>"+id+"]) }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'product_id': id
            },
            success: function(data) {
                console.log(data);
                alert('Product added to favourites');
            },
            error: function(data) {
                console.log(data);
                alert('Product already added to favourites');
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
        @foreach ($products as $product)
            <div style="width: 20rem" class="mx-3 my-3">
                <div class="flex flex-col break-2">
                    <div class="flex-1 bg-white rounded-lg shadow-lg overflow-hidden border-b border-gray-200">
                        <div >
                            
                            <div id="favourite-button" class="flex justify-center">
                                <button onclick="addToFavourites( {{ $product->id }} )" class="btn bg-blue-600 hover:bg-blue-700 text-red font-bold py-1 px-4 rounded-full">
                                    Add to favourites
                                </button>
                            </div>
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid">
                            <div class="font-bold text-xl mb-2 text-right px-3">
                                <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                            </div>
                            <p class="text-gray-700 text-right px-3">
                                {{ $product->price }} EGP
                            </p>
                        </div>
                        <div class="px-6 py-4">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#{{ $product->category[0]->name }}</span>
                            
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- pagination --}}
    <div class="flex justify-center">
        {{ $products->links() }}
    </div>

</x-app-layout>
   