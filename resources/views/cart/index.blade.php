<x-app-layout>
    <div>{{ Breadcrumbs::render('cart') }}</div>

    @forelse ($products as $product)
        <x-cart-product-card :product='$product' :quantity='$quantity[$product->id]["quantity"]'/>
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
    {{-- Total price & coupons --}}
    <div class="flex justify-between mt-8">
        <div>Coupons</div>
        {{-- Total Price --}}
        <x-cart-price-counter :$products :$quantity/>
    </div>
    {{-- Buttons --}}
    <div class="flex justify-between mt-6">
        <a href="{{ route('products.index') }}" class="m-2 p-2 rounded-md bg-gray-200 text-sm font-semibold shadow-sm hover:bg-gray-300 border-zinc-400 border focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">Continue shopping</a>
        <a href="{{ route('address') }}" class="m-2 p-2 my-2 rounded-md bg-sky-400 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">Process to address</a>
    </div>
</x-app-layout>