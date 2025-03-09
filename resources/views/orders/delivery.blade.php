<x-app-layout>
    <div>{{ Breadcrumbs::render('order-delivery') }}</div>

    <form action="" method="POST" class="mt-6 relative">
        @csrf
        <div class="space-y-6">
            <div class="space-y-2">
                <h3 class="text-gray-900 font-bold text-base">Select delivery method:</h3>
                <div class="flex space-x-2">
                    <div class="w-1/2">
                        <x-input-label for="first_name" :required="true">First Name</x-input-label>
                        <x-text-input type="text" name="first_name" required class="w-full" value="{{ old('name', $user->first_name ?? '') }}"></x-text-input>
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>
                    <div class="w-1/2">
                        <x-input-label for="last_name" :required="true">Last Name</x-input-label>
                        <x-text-input type="text" name="last_name" required class="w-full" value="{{ old('name', $user->last_name ?? '') }}"></x-text-input>
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>
                </div> 
                <div class="flex space-x-2">
                    <div class="w-1/2">
                        <x-input-label for="email" :required="true">Email</x-input-label>
                        <x-text-input type="email" name="email" required class="w-full" value="{{ old('name', $user->email ?? '') }}"></x-text-input>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="w-1/2">
                        <x-input-label for="phone_number" :required="true">Phone</x-input-label>
                        <x-text-input type="text" name="phone_number" required class="w-full" value="{{ old('name', $user->phone_number ?? '') }}"></x-text-input>
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>
                </div> 
            </div>
            <div class="space-y-2">
                <h3 class="text-gray-900 font-bold text-base">Choose payment method:</h3>
                <div class="flex space-x-2">
                    <div class="w-1/2">
                        <x-input-label for="street" :required="true">Street</x-input-label>
                        <x-text-input type="text" name="street" required class="w-full" value="{{ old('name', $user->address->street ?? '') }}"></x-text-input>
                        <x-input-error :messages="$errors->get('street')" class="mt-2" />
                    </div>
                    <div class="w-1/2">
                        <x-input-label for="street_number" :required="true">Street Number</x-input-label>
                        <x-text-input type="text" name="street_number" required class="w-full" value="{{ old('name', $user->address->street_number ?? '') }}"></x-text-input>
                        <x-input-error :messages="$errors->get('street_number')" class="mt-2" />
                    </div>
                </div>
                <div class="flex space-x-2">
                    <div class="w-1/2">
                        <x-input-label for="post_code" :required="true">Post Code</x-input-label>
                        <x-text-input type="text" name="post_code" required class="w-full" value="{{ old('name', $user->address->post_code ?? '') }}"></x-text-input>
                        <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
                    </div>
                    <div class="w-1/2">
                        <x-input-label for="city" :required="true">City</x-input-label>
                        <x-text-input type="text" name="city" required class="w-full" value="{{ old('name', $user->address->city ?? '') }}"></x-text-input>
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>
                </div>
                <div class="flex pr-2">
                    <div class="w-1/2">
                        <x-input-label for="country" :required="true">Country</x-input-label>
                        <x-text-input type="text" name="country" required class="w-full" value="{{ old('name', $user->address->country ?? '') }}"></x-text-input>
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>
                </div>
                <div class="flex space-x-2">
                    <div class="w-full">
                        <label for="different_address" class="text-sm flex items-center">
                        <input id="different_address" type="checkbox" name="different_address" value="true" {{ old('different_address') == 'true' ? 'checked' : '' }} class="rounded bg-transparent border-gray-500  text-gray-500 shadow-sm dark:focus:ring-indigo-300" onclick="toggleAddress()">
                        <span class="ms-2 text-sm text-gray-700">{{ __('Different shipping address?') }}</span>
                    </label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Buttons --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('order.address') }}" class="p-2 rounded-md bg-gray-200 text-sm font-semibold shadow-sm hover:bg-gray-300 border-zinc-400 border focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">Back to Cart</a>
            {{-- <a href="{{ route('address.store') }}" class="p-2 rounded-md bg-sky-400 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">
            <button type="submit">Continue</button>
            </a> --}}
            <button type="submit" class="p-2 rounded-md bg-sky-400 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 flex items-center">Continue</button>
        </div>
    </form>
</x-app-layout>