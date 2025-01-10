<x-app-layout>
    <div>{{ Breadcrumbs::render('cart') }}</div>
    @forelse ($products as $product)
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
            @livewire('cart-product-card', ['product' => $product, 'quantity' => $quantity[$product->id]['quantity']])
            <form action="{{ route('cart.update', $product->id) }}" method="POST" class="flex items-center mx-2">
                @csrf
                @method('PUT')
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 stroke-red-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>                  
                </button>
            </form>
        </div>
    @empty
        <div class="rounded-md border border-dashed border-zinc-900 p-8 my-8">
            <div class="text-center">
                Cart is empty.
            </div>
            <div class="text-center">
                Go find some products <a class="text-blue-500 hover:underline" href="{{ route('home') }}">here!</a>
            </div>
        </div>
    @endforelse
    {{-- Total price & coupon --}}
    <div class="flex justify-between mt-8">
        <div>Coupons</div>
        <div>Total Price</div>
    </div>
    {{-- Buttons --}}
    <div class="flex justify-between mt-6">
        <a href="{{ route('products.index') }}" class="m-2 p-2 rounded-md bg-gray-200 text-sm font-semibold shadow-sm hover:bg-gray-300 border-zinc-400 border focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">Continue shopping</a>
        <a href="" class="m-2 p-2 my-2 rounded-md bg-sky-400 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">Continue</a>
    </div>
</x-app-layout>