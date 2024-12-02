<x-app-layout>
    <div class="flex flex-col">
        <div class="px-4">{{ Breadcrumbs::render('products.index') }}</div>
        <div class="grid grid-cols-3">
            @foreach ($products as $product)
                <x-card :$product>
                    
                </x-card>
            @endforeach
        </div>
    </div>
</x-app-layout>