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
                    <option> <i class='fa fa-calculator' aria-hidden='true'></i>Option2</option>
                @endforeach
            </select>
        </div>
        {{-- product colors selectable div preview --}}
        <div class="text-gray-600 text-sm my-2 px-3">
            <div class="flex flex-wrap">
                @foreach($product->product_variances as $color)
                    {{-- <div class="w-1/4"> --}}
                    <div class="bg-gray-200 rounded-full h-8 w-8" 
                        style="background-color: {{ $color->color_code }}"
                        onmousemove="this.opacity=0.8"
                        onmouseout="this.opacity=1"
                        onclick="chooseColor('{{ $color->color_code }}')">
                    </div>
                        
                    {{-- </div> --}}
                @endforeach
            </div>
        </div>
        
        {{-- share product and add to cart --}}
        <div>
            <span>
                <input 
                type="number" 
                min="0" 
                max="100" 
                value="0" 
                style=" margin-left: 1.5rem ;margin-left: 1rem !important;outline: 0 none;border: 0 none;text-align: center;width: 7rem;height: 2rem;cursor: pointer;color: rgb(106, 106, 106);background-color: #fff;border-radius: 0.5rem;box-shadow: 0 0.01rem .01rem rgba(0, 0, 0, 0.2);"
                id="{{ 'N_'.$product->id }}" 
                onchange="addToCart('{{ $product->id }}');">
            </span>
        </div>
    </div>
</div>

<script>
    function showImage(id, url) {
        document.getElementById(id).src = url;
    }
    function chooseColor(color) {
        document.getElementById('color').value = color;
    }
</script>

                    
</x-app-layout>
   