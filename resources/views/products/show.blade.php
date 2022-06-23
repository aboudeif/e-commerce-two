<x-app-layout>
    {{-- show product --}}
    
    <style>
        
/* show product elements in responsive grid */
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
grid-template-columns: repeat(3, 1fr);
grid-template-rows: repeat(12, 1fr);
grid-column-gap: 0px;
grid-row-gap: 0px;
}

.div1  { grid-area: 1 / 1 / 2 / 4; display: flexbox;max-width: 100%;}
.div1 > img {display: inline-block; max-height: 10rem;  } /* max-height: 1rem; */
.div2 { grid-area: 2 / 1 / 8 / 4; }
.div3 { grid-area: 8 / 1 / 13 / 4; }

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
            <img src="{{ $media->media_url }}" alt="{{ $product->name }}" class="img-fluid">
        @endforeach
    </div>
    {{-- product main image --}}
    <div class="div2">
        <img src="{{ $product->product_media->first()->media_url }}" alt="{{ $product->name }}" class="img-fluid">
    </div>
    {{-- product name --}}
    <div class="div3">
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
            {{ $product->product_variances->first()->price }} EGP
        </div>
       
        {{-- product size menu --}}
        <div class="text-gray-600 text-sm my-2 text-right px-3">
            <select class="selectpicker w-full" name="size" id="size">
                @foreach($product->product_variances as $size)
                    {{-- <option value="{{ $size->size }}" class="material-symbols-outlined">
                        production_quantity_limits <i class="text-base">{{ $size->size }}</i>
                    </option> --}}
                    {{-- <option> </i>{{ $size->size }}</option> --}}
                    <option value="{{ $size->size }}">{{ $size->size }}</option>
                @endforeach
            </select>
        </div>
        {{-- product colors selectable div preview --}}
        <div class="text-gray-600 text-sm my-2 px-3">
            <div class="flex flex-wrap">
                <input type="hidden" name="color" id="color" value="{{ $product->product_variances->first()->color }}">
                @foreach($product->product_variances as $color)
                    {{-- <div class="w-1/4"> --}}
                    <div class="bg-gray-200 rounded-full h-8 w-8" 
                        style="background-color: {{ $color->color_code }}"
                        onmousemove="this.opacity=0.8"
                        onmouseout="this.opacity=1"
                        onclick="chooseColor(this);">
                        
                    </div>
                        
                    {{-- </div> --}}
                @endforeach
            </div>
        </div>
        
        {{-- share product and add to cart --}}
        <div>
            <span
                id="{{ 'C_'.$product->product_variances->first->id->id }}"
                onclick="addToCart('{{ $product->product_variances->first->id->id }}');" 
                onmousemove="$(this).css('opacity', '0.8');" 
                onmouseout="$(this).css('opacity', '1');"
                class=" {{ $product->carts->first->product_id ? 'text-green-500' : 'text-gray-500' }} position-absolute mx-4 my-1 cursor-pointer material-symbols-outlined user-select-none "
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
                onchange="addToCart('{{ $product->id }}');">
            </span>
        </div>
    </div>
</div>

<script>
    function addToCart(id) {
        var quantity = $('#quantity').val();
        var color = $('#color').val();
        var size = $('#size').val();
        $.ajax({
            url: '/cart/'+id+'/store',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_variance_id: id,
                quantity: quantity,
                color: color,
                size: size
            },
            success: function(data) {
                if(data.status == 'success') {
                    $('#C_'+id).removeClass('text-gray-500');
                    $('#C_'+id).addClass('text-green-500');
                    $('#C_'+id).attr('onclick', 'removeFromCart('+id+')');
                    $('#C_'+id).attr('title', 'حذف المنتج من سلة المشتريات');
                    
                    
                }
            },

            error: function(data) {
                    alert(data.message);
                }  
            });
    }

    function removeFromCart(id) {
        $.ajax({
            url: '/cart/'+id+'/destroy',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_variance_id: id
            },
            success: function(data) {
                if(data.status == 'success') {
                    $('#quantity').val(0);
                    $('#C_'+id).removeClass('text-green-500');
                    $('#C_'+id).addClass('text-gray-500');
                    $('#C_'+id).attr('onclick', 'addToCart('+id+')');
                    $('#C_'+id).attr('title', 'إضافة المنتج  إلي سلة المشتريات');
                    $('#C_'+id).html('shopping_cart');
                }
            },

            error: function(data) {
                    alert(data.message);
                }  
            });
    }

</script>
<script>
    function chooseColor(color) {
        var color_code = $(color).css('background-color');
        $('#color').childList.forEach(element => {
            $(element).css('border', 'none');
        });
        $(color).css('border', '1px solid gray');
        $('#color').val(color_code);
    }

    function showImage(id, url) {
        document.getElementById(id).src = url;
    }
    
    function chooseColor(color) {
        document.getElementById('color').value = color;
    }

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
// }
</script>

                    
</x-app-layout>
   