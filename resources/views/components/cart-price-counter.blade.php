<div class="w-1/3 flex justify-between">
    <div class="flex flex-col text-right">
        <p class="text-sm text-gray-500">Total excluding VAT</p>
        <p class="font-bold">To pay</p> 
    </div>
    <div class="flex flex-col text-right">
        <p class="text-sm text-gray-500">{{ number_format($totalPriceWithoutVAT,2,',',' ') }} €</p>
        <p class="font-bold text-green-600">{{ number_format($totalPrice,2,',',' ') }} €</p>
    </div>
</div>