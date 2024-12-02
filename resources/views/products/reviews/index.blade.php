<x-app-layout>
    <div class="px-4">{{ Breadcrumbs::render('products.reviews.index', $product) }}</div>
    <div class="flex justify-evenly py-4 my-4 border-b-2 border-gray-300 border-dashed">
        <div class="flex flex-col ">
            <div class="text-5xl text-center">{{round($product->reviews_avg_rating,1)}}</div>
            <div class="text-center"><x-star-rating :rating="$product->reviews_avg_rating"/></div>
            <div class="text-sm text-center text-gray-400">Reviewed by <a href="#" class="underline">{{$product->reviews_count}} customers</a></div>
            <div class="mx-2 flex items-center justify-center">
                <div class="my-2 rounded-md bg-sky-400 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">
                    <span class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                    </span> 
                    <a href="#">Add review</a>
                </div>
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
    @forelse ($product->reviews as $review)
        <div class="py-6 border-b-2 border-gray-300">
            <div class="flex flex-col">
                <h3>USER - author</h3>
                <p class="text-sm text-gray-400">Rated {{$review->created_at->format('d/m/y')}}</p>
                <div class="flex justify-start">
                    <div class="mr-2"><x-star-rating :rating="$review->rating"/></div>
                    <div class="mx-2">Verified purchase</div>
                </div>
            </div>
            <div>
                <div class="flex justify-start py-2">
                    <div class="flex flex-col w-1/2">
                        @forelse (json_decode($review->advantages) as $advantage)
                            <div class="flex">
                                <div class="self-center mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>  
                                <p class="self-center">{{$advantage}}</p>
                            </div>
                        @empty
                            
                        @endforelse
                    </div>
                    <div class="flex flex-col w-1/2">
                        @forelse (json_decode($review->disadvantages) as $disadvantage)
                            <div class="flex">
                                <div class="self-center mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>                                      
                                </div>  
                                <p class="self-center">{{$disadvantage}}</p>
                            </div>
                        @empty
                            
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="py-2">
                <p>{{ $review->review }}</p>
            </div>
            <div class="flex">
                <button></button>
            </div>
        </div>
        
    @empty
        <div class="rounded-md border border-dashed border-zinc-900 p-8">
            <div class="text-center">
                No reviews.
            </div>
            <div class="text-center">
                Go find some products <a class="text-blue-500 hover:underline" href="{{ route('home') }}">here!</a>
            </div>
        </div>
    @endforelse
</x-app-layout>