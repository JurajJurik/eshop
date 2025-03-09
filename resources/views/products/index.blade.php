<x-app-layout>
    <div class="flex flex-col">
        <div>{{ Breadcrumbs::render('products.index') }}</div>
        <div class="grid grid-cols-3">
            @foreach ($products as $product)
                <x-card :$product>
                    
                </x-card>
            @endforeach
        </div>
    </div>
    <div class="mb-6">{{ $products->links() }}</div>
</x-app-layout>