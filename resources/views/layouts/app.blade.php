<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel Eshop') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="mx-auto max-w-6xl text-slate-700 text-lg bg-beige font-mono">
        @livewireScripts
        <div class="mb-4 flex justify-between font-medium h-auto">
            <div class="flex justify-start">
                <div class="min-w-52">
                    <x-logo></x-logo>
                </div>
                <!-- Search bar -->
                <div class="flex items-center mx-6 h-auto">
                    <form action="{{ route('products.index') }}" method="GET" class="flex items-center mx-6">
                        <div class="border-solid border-2 rounded-l-lg border-zinc-500 h-12 min-w-96">
                            <input type="text" id="search" name="search" class="bg-transparent size-full border-none focus:ring-0" value="{{ request('search') }}" placeholder="Search for any text"/>
                        </div>
                        <div class="border-solid border-t-2 border-r-2 border-b-2 rounded-r-lg border-zinc-500 h-12 px-4 bg-darkerBeige">
                            <button class="bg-transparent size-full border-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                              </svg>
                            </button>    
                        </div>
                    </form>
                </div>
            </div>
            <!-- Login/wishlist/cart bar -->
            <div class="flex justify-start">
                <div class="flex items-center mx-6">
                    <ul class="flex space-x-6">
                        @if (!Auth::check())
                            <li>
                                <a href="{{ route('login') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                                    </svg>  
                                </a>
                            </li>
                        @else
                            <li>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>                                  
                                </div>
                            </li>
                            <li>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>                                  
                                </div>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                        </svg>
                                    </button>
                                </form>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('cart.index') }}">
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                    @livewire('cart-icon-counter')
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- <ul class="flex space-x-2">
                @auth
                    <li>
                        {{ auth()->user()->name ?? 'Anonymous' }}
                    </li>
                    <li>
                        <a href="{{ route('my-job-applications.index') }}">My Applications</a>
                    </li>
                    <li>
                        <a href="{{ route('my-jobs.index') }}">My Jobs</a>
                    </li>
                    <li>
                        <form action="{{ route('auth.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Logout</button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('auth.create') }}">Sign in</a>
                    </li>
                @endauth
            </ul> --}}
        </div>

        <div class="flex justify-start">
            <sidebar class="min-w-52">
                <x-sidebar></x-sidebar>
            </sidebar>
            <main class="w-full px-4">
                @if (session('success'))
                    <div role="alert" class="px-4 mb-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
                        <p class="font-bold">Success!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('warning'))
                    <div role="alert" class="px-4 mb-8 rounded-md border-l-4 border-orange-300 bg-orange-100 p-4 text-orange-700 opacity-75">
                        <p class="font-bold">Warning!</p>
                        <p>{{ session('warning') }}</p>
                    </div>
                @endif
        
                @if (session('error'))
                    <div role="alert" class="px-4 mb-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75">
                        <p class="font-bold">Error!</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
