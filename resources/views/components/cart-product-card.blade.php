<div class="flex border-b-2 border-gray-300">
    <div class="m-2 p-2 flex w-2/3">
        <div class="size-16 ml-2 mr-4">
            <a href="{{ route('products.show', $product) }}">    
                <div class="w-full">
                    {!!html_entity_decode($product->image)!!}
                </div>
            </a>
        </div>
        <div class="flex items-center">
            <a href="{{ route('products.show', $product) }}">{{$product->name}}</a>
        </div>
    </div>
    {{-- Quantity and price component --}}
    <x-cart-product-counter :product='$product' :quantity='$quantity'/>
    <form action="{{ route('cart.update', $product->id) }}" method="POST" class="flex items-center mx-2">
        @csrf
        @method('PUT')
        <input type="text" name="event" value="remove" hidden>
        <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 stroke-red-700">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>                  
        </button>
    </form>
</div>