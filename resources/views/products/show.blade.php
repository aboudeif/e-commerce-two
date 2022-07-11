<x-app-layout>
    {{-- show product --}}
    
    <style>
        
/* show product elements in responsive grid*/
.parent {
display: grid;
grid-template-columns: repeat(7, 1fr);
grid-template-rows: repeat(4, 1fr);
grid-column-gap: 0px;
grid-row-gap: 0px;
}
/* media small screen */

.div1 { grid-area: 1 / 7 / 5 / 8; }
.div2 { grid-area: 1 / 4 / 5 / 7; }
.div3 { grid-area: 1 / 1 / 5 / 4; }

@media screen and (max-width: 800px) 
{
    .parent {
display: grid;
grid-template-columns: repeat(1, 1fr);
grid-template-rows: 0.5fr 1fr 1.5fr;
grid-column-gap: 0px;
grid-row-gap: 0px;
}

.div1  { grid-area: 1 / 1 / 2 / 4; display: flexbox;max-width: fit-content;}
.div1 > img {display: inline-block; max-height: 10rem;  } /* max-height: 1rem; */
.div2 { grid-area: 2 / 1 / 3 / 2; width: fit-content; height: fit-content; }
.div3 { grid-area: 3 / 1 / 4 / 2; width: fit-content; height: fit-content; }

} 

.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 48
}


</style>



{{-- {{ dd($product); }} --}}

<div class="parent">
    {{-- all product images --}}
    
    <div class="div1">
        
        @foreach($product_media as $media)
            <img src="{{ $media->media_url }}" alt="{{ $product->name }}" class="img-thumbnail inline" width="100" height="100">
        @endforeach
    </div>
    {{-- product main image --}}
    <div class="div2 mx-2 my-y">
        <img src="{{ $product_media->first()->media_url }}" alt="{{ $product->name }}" class="img-fluid rounded-2">
    </div>

    {{-- product name --}}
    <div class="div3 mx-4" dir="rtl">
        <div class="font-bold text-xl my-2 text-right px-3  py-3">
                {{ $product->name }}
        </div>
        {{-- product description --}}
        <div class="text-gray-700 text-base my-3 mx-3">
            {{ $product->description }}
        </div>
     
        {{-- product price - large font - blue color --}}
        <div class="text-green-700 text-xl font-bold my-2 py-3 text-right px-3">
            {{ $product->price }} ج.م
        </div>
       
        {{-- product size menu --}}
        <div class="text-gray-600 text-sm my-2 text-right px-3">
            <select class="selectpicker w-full" name="selected_size" id="selected_size">
               
            </select>
        </div>
        
        {{-- product colors selectable div preview --}}
        <div class="text-gray-600 text-sm my-2 px-3">
            <div class="flex flex-wrap">
                <input type="hidden" id="selected_color" name="selected_color" type="text"/>
              {{-- {{ dd($product->product_variances->first()) }} --}}
                @foreach($product_variances as $variance)
                    
                    <div class="rounded-full h-8 w-8 bg-gray-200 mr-2 mb-2 color_circle cursor-pointer"
                        style="background-color: {{ $variance->color_code}}"
                        onclick="chooseColor('{{ $variance->color }}', '{{ $product->id }}');">
                    </div>
                    {{-- </div> --}}
                @endforeach
                <style>
                    .color_circle:hover{
                        outline: 2px  solid gray;
                    }
                </style>
            </div>
        </div>
        
        <script>
            function chooseColor(color,id) {
                
                $.ajax({
                    url: "{{ route('variances.size') }}",
                    type: 'POST',

                    

                    data: {
                        _token: '{{ csrf_token() }}',
                        color: color,
                        product_id: id
                    },
                //success and fail
                success: function(data) {
                    console.log(data);
                    $('#selected_size').empty();
                    if(data.length > 0){
                        
                    data.forEach(element => {
                        $('#selected_size').append('<option value="'+element+'">'+element+'</option>');
                        
                       
                    });
                    }
                    else{
                        $('#selected_size').append('<option value="">لا يوجد مقاسات متاحة</option>');
                    }
                    $('#selected_color').val(color);

                },
                error: function(data) {
                    console.log(data);
                }
                });
            }
        </script>

        {{-- share product and add to cart --}}
        <div class="ml-4 mr-2">
            <x-jet-button type="submit" class="w-full text-center"
                id="cart"
                onclick="addToCart();"
                onmousemove="$(this).css('opacity', '0.8');" 
                onmouseout="$(this).css('opacity', '1');"
                ><span class= " my-1 cursor-pointer material-symbols-outlined user-select-none w-full text-center"
                title='إضافة المنتج  إلي سلة المشتريات أو حذفه منها'>
                shopping_cart
                </span>
            </x-jet-button>
        </div>
    </div>
</div>
<div id="cart-notification" class="alert alert-success text-center absolute right-auto top-auto " role="alert" 
style="display:none;color:#fff;opacity:0.8;transition: display 2s; ">
    
</div>
<script>

    function addToCart() {

        const quantity = $('#quantity').val()
        
        const color = $('#selected_color').val();
        const size = $('#selected_size').val();
        if($('#selected_color').val() == ''){
            $('#cart-notification').html('الرجاء تحديد اللون والمقاس');
            $('#cart-notification').css('background-color', 'orange');
            $('#cart-notification').css('display', 'block');
            setTimeout(function() {
                $('#cart-notification').css('display', 'none');
            }, 3000);
            return;
        }
        $.ajax({
            url: "{{ route('carts.store') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                quantity: 1,
                color: color,
                size: size
            },
            success: function(data) {

                console.log(data);
                if(data.action == 'add'){
                $('#cart-notification').html('تم إضافة المنتج إلي سلة المشتريات');
                $('#cart-notification').css('background-color', 'green');
                }
                else{
                $('#cart-notification').html('تم حذف المنتج من سلة المشتريات');
                $('#cart-notification').css('background-color', 'red');
                }
                $('#cart-notification').css('display', 'block');
                setTimeout(function() {
                    $('#cart-notification').css('display', 'none');
                }, 3000);
                    
                
                },
            error: function(data) {
                    console.log(data);
                   
                }  
            });
    }
    // function is_in_cart
    function is_in_cart() {
        const color = $('#selected_color').val();
        const size = $('#selected_size').val();
        $.ajax({
            url: "{{ route('cart.check') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                color: color,
                size: size
            },
            success: function(data) {
                console.log(data);
                if(data.is_in_cart) {
                    $('#cart').removeClass('text-gray-500');
                    $('#cart').addClass('text-green-500');
                    $('#cart').attr('onclick', removeFromCart());
                    $('#cart').attr('title', 'حذف المنتج من سلة المشتريات');
                    
                }
                },
            error: function(data) {
                    console.log(data);
                }  
            });
    }

    // when user change size, reload avilable color of selected size and price
    function changeSize(id) {
        $.ajax({
         
            url: "{{ route('variances.size') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                size: $('#size').val(),
                product_id: id
            },
            success: function(data) {
                if(data.status == 'success') {
                    // load colors of selected size using for each loop
                    $('#color').html('');
                    $('#color').append('<option value="">اللون</option>');
                    $.each(data.colors, function(key, value) {
                        $('#color').append('<option value="'+value.id+'">'+value.name+'</option>');
                    });

                    // load price of selected size
                    $('#price').html(data.price);
                }
            },

            error: function(data) {
                    alert('error');
                }  
            });
    }

    function showImage(id, url) {
        document.getElementById(id).src = url;
    }
</script>
    
  

                    
</x-app-layout>
   