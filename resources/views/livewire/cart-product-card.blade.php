<div class="flex justify-between py-6 w-1/3">
    @php
        $stroke = "1";
        if ($quantity == 1) 
        {
            $stroke = "none";
        }   
    @endphp
    <div class="flex flex-row">
        <div class="flex items-center mr-2">
            <button wire:click="subQuantity({{$product->id}})">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor" class="size-8 stroke-{{$stroke}}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>  
            </button>                        
        </div>
        <div class="w-12 rounded-lg grid content-center border border-zinc-400">
            <div class="justify-self-center">{{$quantity}}</div>
        </div>
        <div class="flex items-center ml-2">
            <button wire:click="addQuantity({{$product->id}})">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </button>                      
        </div>
    </div>
    <div class="flex justify-between">
        <div class="flex items-center">
            {{number_format($quantity * $product->price,2,',',' ')}} €
        </div>
    </div>
</div>