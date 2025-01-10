@foreach ($categories as $category)
    <div  class="flex justify-start items-center w-full p-2 border-zinc-500 border-b">
        <button class="flex justify-start text-slate-700 rounded w-full" onclick="toggleDropdown({{ $category->id }})">
            <div class="size-6">{!!html_entity_decode($category->icon)!!}</div>
            <div class="flex justify-between w-full">
                <p class="text-lg font-bold text-nowrap leading-4 mx-2">{{Str::ucfirst( $category->name )}}</p>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                  
            </div>
        </button>
    </div>   

    <div id="dropdown-{{ $category->id }}" class="{{ Request::get('category') ==  $category->name ? '' : 'hidden'  }}">
        @foreach ( $category->subCategory as $subcategory)
            <x-dropdown :category='$category->name' :subcategory='$subcategory->name'/>
        @endforeach        
    </div>
@endforeach

<script>
    function toggleDropdown(categoryId) {
        const dropdown = document.getElementById(`dropdown-${categoryId}`);
        dropdown.classList.toggle('hidden');
    }
</script>