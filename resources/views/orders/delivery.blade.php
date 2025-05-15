<x-app-layout>
    <div>{{ Breadcrumbs::render('order-delivery') }}</div>

    @dump(session()->get('order_address'))

    <form action="{{ route('order.delivery') }}" method="POST" class="mt-6 relative">
        @csrf
        <div class="space-y-6">
            <div class="space-y-2">
                <h3 class="text-gray-700 font-bold text-base">Select payment method:</h3>
                <select class="bg-transparent border-2 rounded-md" name="payment_method">
                    
                    <option  value="">-- NONE --</option>
                    @foreach (\App\Models\User::$paymentMethod as $paymentMethod)
                        @if (!Auth::user())
                            <option  value="{{ $paymentMethod }}">{{Str::ucfirst( $paymentMethod ) }}</option>
                        @else
                            @if (Auth::user()->payment_method == $paymentMethod)
                                <option  value="{{ $paymentMethod }}" selected>{{Str::ucfirst( $paymentMethod ) }}</option>
                            @else
                                <option  value="{{ $paymentMethod }}">{{Str::ucfirst( $paymentMethod ) }}</option>
                            @endif
                        @endif
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
            </div>
            <div class="space-y-2">
                <h3 class="text-gray-700 font-bold text-base">Choose delivery method:</h3>
                <select class="bg-transparent border-2 rounded-md" name="delivery_method">
                    <option  value="">-- NONE --</option>
                    @foreach (\App\Models\User::$deliveryMethod as $deliveryMethod)
                        @if (!Auth::user())
                            <option  value="{{ $deliveryMethod }}">{{Str::ucfirst( $deliveryMethod ) }}</option>
                        @else
                            @if (Auth::user()->delivery_method == $deliveryMethod)
                                <option  value="{{ $deliveryMethod }}" selected>{{Str::ucfirst( $deliveryMethod ) }}</option>
                            @else
                                <option  value="{{ $deliveryMethod }}">{{Str::ucfirst( $deliveryMethod ) }}</option>
                            @endif
                        @endif
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('delivery_method')" class="mt-2" />
            </div>
        </div>
        {{-- Buttons --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('address') }}" class="p-2 rounded-md bg-gray-200 text-sm font-semibold shadow-sm hover:bg-gray-300 border-zinc-400 border focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">
                Back to Address
            </a>
            <button type="submit" class="p-2 rounded-md bg-sky-400 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">
                Summary
            </button>
        </div>
    </form>
</x-app-layout>

{{-- <form action="{{ route('order.xxx') }}" method="POST" class="mt-6 relative">
    @csrf
    <button type="submit" class="p-2 rounded-md bg-sky-400 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">
        Finish order
    </button>
</form> --}}