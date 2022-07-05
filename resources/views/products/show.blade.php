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



<div class="parent">
    {{-- all product images --}}
    
    <div class="div1">
        
        @foreach($product->product_media as $media)
            <img src="{{ $media->media_url }}" alt="{{ $product->name }}" class="img-thumbnail inline" width="100" height="100">
        @endforeach
    </div>
    {{-- product main image --}}
    <div class="div2">
        <img src="{{ $product->product_media->first()->media_url }}" alt="{{ $product->name }}" class="img-fluid">
    </div>
    {{-- product name --}}
    <div class="div3" dir="rtl">
        <div class="font-bold text-xl my-2 text-right px-3  py-3">
            <a href="{{ route('products.show', $product->id) }}">
                {{ $product->name }}
            </a>
        </div>
        {{-- product description --}}
        <div class="text-gray-700 text-base my-3">
            {{ $product->description }}
        </div>
     
        {{-- product price - large font - blue color --}}
        <div class="text-green-700 text-xl font-bold my-2 py-3 text-right px-3">
            {{ $product->price }} EGP
        </div>
       
        {{-- product size menu --}}
        <div class="text-gray-600 text-sm my-2 text-right px-3">
            <select class="selectpicker w-full" name="selected_size" id="selected_size">
               
            </select>
        </div>
        
        {{-- product colors selectable div preview --}}
        <div class="text-gray-600 text-sm my-2 px-3">
            <div class="flex flex-wrap">
                <input id="selected_color" name="selected_color" type="text"/>
              
                @foreach($product->color as $color_code => $color_name)
                    
                    <div class="rounded-full h-8 w-8" 
                        style="background-color: {{ $color_code }};"
                        onmousemove="$(this).css('opacity','0.8');"
                        onmouseout="$(this).css('opacity','1');"
                        
                        onclick="chooseColor('{{ $color_name }}', '{{ $product->id }}');">

                    </div>
                    {{-- </div> --}}
                @endforeach
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
                    
                    // add sizes from data to selectpicker #size
                    //clear selectpicker #size
                    $('#selected_size').empty();
                    
                    data.forEach(element => {
                        //add every size to selectpicker
                        $('#selected_size').append('<option value="'+element+'">'+element+'</option>');
                        
                       
                    });
                    
                    // refresh #size
                    
                    
                    $('#selected_color').val(color);
                },
                error: function(data) {
                    console.log(data);
                }
                });
            }
        </script>

        {{-- share product and add to cart --}}
        <div>
            <span
                id="cart"
                onclick="addToCart();"
                onmousemove="$(this).css('opacity', '0.8');" 
                onmouseout="$(this).css('opacity', '1');"
                class= "text-gray-500 position-absolute mx-4 my-1 cursor-pointer material-symbols-outlined user-select-none "
                style="font-family: 'Material Icons';z-index: 11;" 
                title='إضافة المنتج  إلي سلة المشتريات أو حذفه منها'>
                shopping_cart
            </span>

            <span>
                <input 
                type="number"
                name="quantity"
                min="0" 
                max="100" 
                value="0" 
                style="margin-left: 1.5rem ;margin-left: 1rem !important;outline: 0 none;border: 0 none;text-align: center;width: 7rem;height: 2rem;cursor: pointer;color: rgb(106, 106, 106);background-color: #fff;border-radius: 0.5rem;box-shadow: 0 0.01rem .01rem rgba(0, 0, 0, 0.2);"
                id="quantity" 
                onchange="">
            </span>
        </div>
    </div>
</div>

<script>

    function addToCart() {

        const quantity = $('#quantity').val()
        if(quantity == 0) {
            alert('الرجاء تحديد الكمية قبل الشراء');
            return;
        }
        const color = $('#selected_color').val();
        const size = $('#selected_size').val();
        $.ajax({
            url: "{{ route('carts.store') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                quantity: quantity,
                color: color,
                size: size
            },
            success: function(data) {

                console.log(data);
                    $('#cart').removeClass('text-gray-500');
                    $('#cart').addClass('text-green-500');
                    // $('#cart').attr('onclick', removeFromCart());
                    $('#cart').attr('title', 'حذف المنتج من سلة المشتريات');
                    
                
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

    // function removeFromCart() {
    //     $.ajax({
    //         url: '/cart/'+id+'/destroy',
    //         type: 'POST',
    //         data: {
    //             _token: '{{ csrf_token() }}',
    //             product_variance_id: id
    //         },
    //         success: function(data) {
    //             if(data.status == 'success') {
    //                 $('#quantity').val(0);
    //                 $('#cart').removeClass('text-green-500');
    //                 $('#cart').addClass('text-gray-500');
    //                 $('#cart').attr('onclick', addToCart());
    //                 $('#cart').attr('title', 'إضافة المنتج  إلي سلة المشتريات');
                  
    //             }
    //         },

    //         error: function(data) {
    //                 alert('error');
    //             }  
    //         });
    // }
    // when user change size, reload avilable color of selected size and price
    function changeSize(id) {
        $.ajax({
            url: '/product/'+id+'/changeSize',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                size: $('#size').val()
            },
            success: function(data) {
                if(data.status == 'success') {
                    // load colors of selected size using for each loop
                    $('#color').html('');
                    $('#color').append('<option value="">اللون</option>');
                    $.each(data.colors, function(key, value) {
                        $('#color').append('<option value="'+value.id+'">'+value.name+'</option>');
                    });

                    // $('#color').html(data.colors);
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
    
    {{--
        // function chooseColor(color) {
    //     var color_code = $(color).css('background-color');
    //     $('#color').childList.forEach(element => {
    //         $(element).css('border', 'none');
    //     });
    //     $(color).css('border', '1px solid gray');
    //     $('#color').val(color_code);
    // }
    // function chooseColor(color) {
    //     document.getElementById('color').value = color;
    // }

//     function addenToCart(id) {

// $.ajax({
//     url: '/cart/'+id+'/store',
//         type: 'POST',
//         data: {
//         '_token': $('meta[name="csrf-token"]').attr('content'),
//         'product_variance_id': id
//         },

//     success: function(data) {
//         var item = document.querySelector('#C_'+ data['id']);
//         if(data['action'] == "add"){
//             item.classList.remove('text-gray-500');
//             item.classList.add('text-green-500');
//         }
//         else{
//             item.classList.add('text-gray-500');
//             item.classList.remove('text-green-500');
//         }

//     },
//     error: function(data) {
//         console.log(data);
//         }
//     });
// } --}}


                    
</x-app-layout>
   