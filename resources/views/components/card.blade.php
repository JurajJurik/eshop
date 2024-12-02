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
        <p class="text-center font-bold min-h-14">{{$product->name}}</p>
    </a>
    <p class="text-sm h-24">{{$product->short_description}}</p>
    <div class="flex flex-row justify-between my-4">
        <div class="flex flex-col min-w-36 text-center">
            <div class="w-full h-4 bg-red-500 rounded-t-md"></div>
            <div class="w-full px-4 py-2 bg-yellow-300 rounded-b-md">{{number_format($product->price,2,',',' ')}} €</div>
        </div>
        <div class="flex text-center">
            <a href="#">
                <button class="border-2 rounded-md border-zinc-500 my-4 px-2 flex items-center bg-gray-200">
                    <span class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </span> 
                    Buy
                </button>
            </a>
        </div>
    </div>
</div>