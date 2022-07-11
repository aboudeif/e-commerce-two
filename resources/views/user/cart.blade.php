<x-app-layout>

   {{-- {{ dd($cart[0]->product->variance->color); }} --}}
    <div class="flex flex-wrap justify-center my-20">
       
        @foreach ($cart as $product)
        <div class="card w-3/4 my-3 mx-3" dir="rtl">
            <div class="card-header">
                
                
        
            <div class="row">
                <div class="col-sm-3 col-4 my-auto">
                    <div class="container text-center">
                    <img src="{{ $cart[0]->product->media[0]->media_url }}" alt="{{ $product->name }}" class="img-fluid inline-block">
                    </div>
                </div>
                <div class="col-sm-2 col-3 my-auto">
                    <h2 class="mt-2">{{ $product->product->name }}</h2>
                    <h5 class="mb-4 rounded-2 bg-gray-200 w-25">{{ $product->product_variance_id }} </h5>

                    <span>اللون: {{ $product->product->variance->color }}</span>
                    <h5>المقاس: {{ $product->product->variance->size }}</h5>
                </div>

                <div class="col-sm-2 col-3 my-auto">
                    {{-- decrease and increase product quantity --}}
                    <div class="row">
                        <div class="col-sm-2 col-3 my-auto mx-auto">
                        
                            <button class="form-control block mt-1 w-full" onclick="increaseQuantity('{{ $product->product_variance_id }}');">
                                +
                            </button>
                            </div>
                            <div class="col-sm-2 col-3 my-auto mx-auto">
                            <x-jet-input class=" block mt-1 w-full" id="quantity-{{ $product->product_variance_id }}"  value="{{ $product->quantity }}"/>
                            </div>
                            <div class="col-sm-2 my-auto mx-auto">
                            <button class="form-control block mt-1 w-full" onclick="decreaseQuantity('{{ $product->product_variance_id }}');">
                               -
                            </button>
                        </div>
                    </div>
                    
                </div>

                <script>
                    function increaseQuantity(id) {
                        
                        var quantity = $('#quantity-'+id).val();
                        quantity++;
                        $('#quantity-'+id).val(quantity);
                        console.log(quantity);
                        updateCart(id, quantity);
                    }
                    function decreaseQuantity(id) {
                        var quantity = $('#quantity-'+id).val();
                        quantity--;
                        if (quantity < 1) {
                            quantity = 1;
                        }
                        $('#quantity-'+id).val(quantity);
                        console.log(quantity);
                        updateCart(id, quantity);
                    }
                    function updateCart(id, quantity) {
                       
                        $.ajax({
                            url: "{{ route('cart.update') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id,
                                quantity: quantity,
                                
                            },
                            success: function(data) {
                                console.log(data);
                                $('#total-price#'+id).html(quantity +"* {{ $product->product->price }}");
                                 location.reload();
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        });
                    }
                </script>

                <div class="col-sm-3 col-6 my-auto">
                    <b id="total-price#{{ $product->product_variance_id }}" style="font-size: 16pt;">{{ $product->product->price * $product->quantity }} ج.م </b>
                </div>

                <div class="col-sm-1 col-1">
                        <form action="{{ route('cart.destroy', ['id'=>$product->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="material-symbols-outlined">
                                delete
                            </button>
                        </form>
                </div>
        
            </div>
        </div>
    </div>
    @endforeach
    </div>
    
    {{-- total price --}}
    <div class="flex justify-center">
        <h2 class="font-semibold text-xl text-gray-800 flex items-center">
            <a href="{{ route('cart.index') }}" class="text-gray-800 hover:text-gray-900 mb-2 mt-4">
                <i class="fas fa-shopping-cart"></i>
                المجموع الكلي: {{ $total }} ج.م
            </a>
        </h2>
    </div>
    {{-- checkout button --}}
    <div class="flex justify-center">
        <form action="{{ route('shipping.create') }}" method="get">
           
            <x-jet-button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded-full">
                المتابعة إلي الشراء
            </x-jet-button>
        </form>
    </div>
</x-app-layout>