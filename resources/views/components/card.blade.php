<div class="max-w-80 m-2 px-2">
    {{-- <img src="{{$product->imageUrl}}" alt="{{$product->name}}"> --}}
    <a href="{{ route('products.show', $product) }}">    
        <div class="w-full">
            {!!html_entity_decode($product->image)!!}
        </div>
    </a>
    <div class="flex justify-evenly items-center">
        <x-star-rating :rating="$product->reviews_avg_rating"/>
        <div>{{round($product->reviews_avg_rating,1)}}</div>
        <div class="text-sm text-gray-400">{{$product->reviews_count}}x</div>
    </div>
    <a href="{{ route('products.show', $product) }}">
        <p class="text-center flex items-center font-bold min-h-24">{{$product->name}}</p>
    </a>
    <p class="text-sm h-24">{{$product->short_description}}</p>
    <div class="flex flex-row justify-between my-4">
        <div class="flex flex-col min-w-36 text-center">
            <div class="w-full h-4 bg-red-500 rounded-t-md"></div>
            <div class="w-full px-4 py-2 bg-yellow-300 rounded-b-md">{{number_format($product->price,2,',',' ')}} €</div>
        </div>
        <div class="flex text-center">
            @livewire('cart-manager',['product' => $product])
        </div>
    </div>
</div>