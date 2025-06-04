<x-app-layout>
    <div>{{ Breadcrumbs::render('order-summary') }}</div>
    @dump($orderData)

    <h3 class="font-bold text-base">Order summary:</h3>
    <div class="flex justify-between">
        <div>
            <div class="mt-3 text-sm">
                <h4 class="font-bold"> Contact details:</h4>
                <p>{{ $orderData->address['email'] }}</p>
                <p>{{ $orderData->address['phone_number'] }}</p>
            </div>
            <div class="mt-3 text-sm">
                <h4 class="font-bold">Address:</h4>
                <p>{{ $orderData->address['first_name'] . " " . $orderData->address['last_name'] }}</p>
                <p>{{ $orderData->address['street'] . " " . $orderData->address['street_number'] }}</p>
                <p>{{ $orderData->address['post_code'] . " " . $orderData->address['country'] }}</p>
            </div>
            <div class="mt-3 text-sm">
                <p><b>Payment method: </b>{{ $orderData->methods['payment_method'] }}</p>
            </div>
            <div class="mt-3 text-sm">
                <p><b>Delivery method: </b>{{ $orderData->methods['delivery_method'] }}</p>
            </div>
        </div>
        <div>
            <div class="flex justify-between">
                @foreach ($orderData->products as $product)
                    <div class="flex justify-between">
                        <div class="flex">
                            <div class="size-10 mx-4 my-2">{!!html_entity_decode($product->image)!!}</div>
                            <p class="text-sm text-gray-400 flex items-center">{{ $orderData->quantities[$product->id]['quantity'] . "x " . $product->name }}</p>
                        </div>
                        <div class="flex ml-4">
                            <p class="text-sm text-gray-400 flex items-center">{{ number_format($product->price,2,',',' ') }} €</p>
                        </div>
                    </div>
                @endforeach
                <div class="flex justify-end">
                    <p class="text-sm text-gray-400 flex items-center">1 x {{Str::ucfirst( $orderData->methods['payment_method'] ) }}</p>
                    <p class="text-sm text-gray-400 flex items-center">{{ number_format($orderData->methods['payment_fee'],2,',',' ') }} €</p>
                </div>
            </div>
        </div>
    </div>
    {{-- Buttons --}}
    <div class="flex justify-between mt-6">
        <a href="{{ route('delivery') }}" class="p-2 rounded-md bg-gray-200 text-sm font-semibold shadow-sm hover:bg-gray-300 border-zinc-400 border focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">
            Back to Delivery & Payment
        </a>
        <form action=" {{ route('order.payment') }}" method="POST">
            @csrf
            <button type="submit" class="p-2 rounded-md bg-sky-400 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">
                Finish order
            </button>
        </form>
    </div>
    @php
        $payment_redirect = true;
        if ($orderData->methods['payment_method'] == 'credit or debit card') {
            $payment_redirect = false;
        }
    @endphp
    <div @class(['flex justify-end space-y-2', 'hidden' => $payment_redirect])>
        <p class="text-sm text-gray-400">* with redirect to payment</p>
    </div>
</x-app-layout>