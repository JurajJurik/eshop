<form method="POST" wire:submit.prevent="save({{$product}})" enctype="multipart/form-data">
    @csrf
    
    @if ($errors->any())
        @dd($errors)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="flex justify-evenly my-4">
        <div class="size-60">
            {!!html_entity_decode($product->image)!!}
        </div>
        <div class="flex flex-col items-center content-between self-center min-h-36">
            <p class="my-2 text-xl">{{ $product->name }}</p>
            <div class="my-2">
                @livewire('select-rating',['product' => $product])
            </div>
            <div>
                @error('rating') 
                    <div class="mt-2 text-xs text-center text-red-500">
                    {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="flex justify-between my-4">
        <div class="w-1/2">
            @livewire('review-add-input',['style' => 'advantages'])
        </div>
            @error('advantages') 
                <div class="mt-2 text-xs text-center text-red-500">
                    {{ $message }}
                </div>
            @enderror
        <div class="w-1/2">
            @livewire('review-add-input',['style' => 'disadvantages'])
        </div>
    </div>
    <div class="flex flex-col my-4">
        <label for="description" class="text-sm">Describe your experience with the product (optional)</label>
        <textarea type="text" wire:model="description" name="description" id="" cols="2" rows="5" class="my-2 border-solid border-2 rounded-lg border-zinc-500 bg-transparent" maxlength="65355"></textarea>
    </div>
    <div class="flex flex-col my-4">
        <label for="reviewPhotos" class="text-sm">Add photo (optional)</label>
        <input type="file" multiple wire:model="photos" name="photos[]" id="" accept="image/*" class="my-2 file:bg-transparent file:border-0 file:underline file:font-bold file:text-blue-500 file:px-2 content-center file:tracking-wider border-dashed w-full rounded-lg h-12 border-2 border-zinc-500">
        @error('photos.*') 
            <div class="mt-1 text-xs text-red-500">
            {{ $message }}
            </div>
        @enderror
    </div>
   
    <div class="flex justify-between my-4">
        <a href="{{ route('products.show', $product) }}"><button type="button" class="my-2 rounded-md bg-gray-300 px-3.5 py-2.5 text-sm font-semibold text-gray-600 shadow-sm hover:bg-gray-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">Cancel</button></a>
        
        <button type="submit" class="my-2 rounded-md bg-sky-400 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">Create review</button>
    </div> 
</form>