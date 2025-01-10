<x-app-layout>
    <div>{{ Breadcrumbs::render('products.show', $product) }}</div>
    <div class="flex justify-between mb-4">
        <div class="size-1/2 flex flex-col p-2">
            <div>{!!html_entity_decode($product->image)!!}</div>
            <div class="flex">
                <div class="w-full">{!!html_entity_decode($product->image)!!}</div>
                <div class="w-full">{!!html_entity_decode($product->image)!!}</div>
                <div class="w-full">{!!html_entity_decode($product->image)!!}</div>
                <div class="w-full">{!!html_entity_decode($product->image)!!}</div>
            </div>
            <div class="flex flex-row justify-evenly my-4">
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

        <div class="flex flex-col size-1/2 p-2">
            <h3 class="font-bold text-2xl my-2">{{$product->name}}</h3>
            <div class="my-2 flex justify-start items-center">
                <div><x-star-rating :rating="$product->reviews_avg_rating"/></div>
                <div class="mx-6">{{round($product->reviews_avg_rating,1)}}</div>
                <div class="text-sm text-gray-400">{{$product->reviews_count}}x</div>
            </div>
            <p class="my-2">Manufacturer: <a href="#" class="underline decoration-solid"><b>{!!$product->manufacturer !!}</b></a></p>
            <p class="my-2">Platform: <a href="#" class="underline decoration-solid"><b>{!!$product->platform !!}</b></a></p>
            <p class="my-2 text-sm text-gray-400">Serial number: {{$product->serial_number}}</p>
            
            <p class="text-justify">{{$product->description}}</p>
        </div>
    </div>

    <div class="flex justify-evenly pt-8 mb-16 border-t-4 border-gray-300">
        <div class="flex flex-col ">
            <div class="text-5xl text-center">{{round($product->reviews_avg_rating,1)}}</div>
            <div class="text-center"><x-star-rating :rating="$product->reviews_avg_rating"/></div>
            <div class="text-sm text-center text-gray-400">Reviewed by <a href="#" class="underline">{{$product->reviews_count}} customers</a></div>
            <div class="mx-2 flex items-center justify-center">        
                <a href="{{route('products.reviews.index', ['product' => $product, 'reviews' => $product->reviews])}}" class="my-2 rounded-md bg-sky-400 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">
                    <span class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                        </svg>  
                    </span> 
                    Show all reviews
                </a>
                <a href="{{ route('products.reviews.create', $product) }}" class="mx-2 rounded-md bg-sky-400 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">
                    <span class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                    </span>
                    Write a review
                </a>
            </div>
        </div>
        <div class="mx-4 flex flex-col">
            @foreach ($counts as $key => $count)
                <div class="flex justify-start">
                    <div class="mx-2">{{$key}}</div>
                    <div class="mx-2"><x-star-rating :rating="$key"/></div>
                    <div class="mx-2 text-sm self-center">{{$count}} x</div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>