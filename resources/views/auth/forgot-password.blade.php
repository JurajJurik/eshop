<x-app-layout>
    

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex flex-col pt-6">
        <div class="flex justify-center">
            <div class="mb-4 text-sm text-gray-700 w-1/2">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
        </div>
        <div class="flex justify-center">
            <form method="POST" action="{{ route('password.email') }}" class="w-1/2">
                @csrf
        
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
        
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
