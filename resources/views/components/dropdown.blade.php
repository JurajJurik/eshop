<div class="flex justify-start items-center w-full p-2">
    <a href="{{ route('products.index', ['category' => $category, 'subcategory' => $subcategory]) }}">
        <p class="text-md text-nowrap leading-4 pl-6 mx-2 {{ Request::get('subcategory') ==  $subcategory ? 'font-bold' : ''  }}">{{Str::ucfirst( $subcategory )}}</p>
    </a>
</div>