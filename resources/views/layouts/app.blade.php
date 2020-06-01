<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('ico/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('ico/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('ico/favicon-16x16.png') }}">
    <link rel="manifest" href="/site.webmanifest">

    @if(config('services.ga.id'))
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-147215234-2"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
              gtag('config', '{{ config('services.ga.id') }}');
            </script>
    @endif

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 h-screen antialiased leading-none">
<div id="app h-full">
    <div class="flex flex-col h-full">
        <nav x-data="{ open: false }" class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="flex items-center px-2 lg:px-0">
                        <div class="flex-shrink-0">
                            <a href="{{ url('/') }}">
                                <div class="text-xl font-semibold text-white">
                                    TodoSync
                                </div>
                            </a>
                        </div>
                        <div class="hidden lg:block lg:ml-6">
                            <div class="flex">
                                @php ($mmActiveClasses = "px-3 mr-4 py-2 rounded-md text-sm leading-5 font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out")
                                @php ($mmInActiveClasses = "mr-4 px-3 py-2 rounded-md text-sm leading-5 font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out")
                                <a href="{{ url('/') }}" class="{{ request()->is('/') ? $mmActiveClasses : $mmInActiveClasses }}">Home</a>
                                <a href="{{ url('/about') }}" class="{{ request()->is('about') ? $mmActiveClasses : $mmInActiveClasses }}">About</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 flex justify-center px-2 lg:ml-6 lg:justify-end">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <a href="{{ url('/settings') }}" class="{{ request()->is('settings') ? $mmActiveClasses : $mmInActiveClasses }}">Settings</a>
                            <a href="{{ route('logout') }}" class="{{ $mmInActiveClasses }}">Logout</a>

                        @else
                            <span class="inline-flex rounded-md shadow">
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-1.5 border border-transparent text-sm leading-6 font-medium rounded-md text-gray-800 bg-white hover:text-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-gray-50 active:text-indigo-700 transition duration-150 ease-in-out">
                              Setup Sync
                            </a>
                          </span>
                        @endif
                    </div>
                    <div class="flex lg:hidden">
                        <!-- Mobile menu button -->
                        <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out" x-bind:aria-label="open ? 'Close main menu' : 'Main menu'" aria-label="Main menu" x-bind:aria-expanded="open" aria-expanded="false">
                            <!-- Icon when menu is closed. -->
                            <svg x-state-on="Menu open" x-state:on="Menu open" x-state-off="Menu closed" x-state:off="Menu closed" :class="{ 'hidden': open, 'block': !open }" x-bind-class="{ 'hidden': open, 'block': !open }" class="block h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <!-- Icon when menu is open. -->
                            <svg x-state-on="Menu open" x-state:on="Menu open" x-state-off="Menu closed" x-state:off="Menu closed" :class="{ 'hidden': !open, 'block': open }" x-bind-class="{ 'hidden': !open, 'block': open }" class="hidden h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    {{--                    <div class="hidden lg:block lg:ml-4">--}}
                    {{--                        <div class="flex items-center">--}}
                    {{--                            <button class="flex-shrink-0 p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out" aria-label="Notifications">--}}
                    {{--                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">--}}
                    {{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />--}}
                    {{--                                </svg>--}}
                    {{--                            </button>--}}

                    {{--                            <!-- Profile dropdown -->--}}
                    {{--                            <div @click.away="open = false" class="ml-4 relative flex-shrink-0" x-data="{ open: false }">--}}
                    {{--                                <div>--}}
                    {{--                                    <button @click="open = !open" class="flex text-sm rounded-full text-white focus:outline-none focus:shadow-solid transition duration-150 ease-in-out" id="user-menu" aria-label="User menu" aria-haspopup="true" x-bind:aria-expanded="open">--}}
                    {{--                                        <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />--}}
                    {{--                                    </button>--}}
                    {{--                                </div>--}}
                    {{--                                <transition enter-active-class="transition ease-out duration-100" enter-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95"><div x-show="open" x-description="Profile dropdown panel, show/hide based on dropdown state." class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">--}}
                    {{--                                        <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">--}}
                    {{--                                            <a href="#" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Your Profile</a>--}}
                    {{--                                            <a href="#" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Settings</a>--}}
                    {{--                                            <a href="#" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Sign out</a>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div></transition>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>

            <div x-description="Mobile menu, toggle classes based on menu state." x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'block': open, 'hidden': !open }" class="hidden lg:hidden">
                <div class="px-2 pt-2 pb-3">
                    @php ($mbActiveClasses = "block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out")
                    @php ($mbInActiveClasses = "mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out")

                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? $mbActiveClasses : $mbInActiveClasses }}">Home</a>
                    <a href="{{ url('/about') }}" class="{{ request()->is('/about') ? $mbActiveClasses : $mbInActiveClasses }}">About</a>

                </div>
                {{--                <div class="pt-4 pb-3 border-t border-gray-700">--}}
                {{--                    <div class="flex items-center px-5">--}}
                {{--                        <div class="flex-shrink-0">--}}
                {{--                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />--}}
                {{--                        </div>--}}
                {{--                        <div class="ml-3">--}}
                {{--                            <div class="text-base font-medium leading-6 text-white">Tom Cook</div>--}}
                {{--                            <div class="text-sm font-medium leading-5 text-gray-400">tom@example.com</div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="mt-3 px-2">--}}
                {{--                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Your Profile</a>--}}
                {{--                        <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Settings</a>--}}
                {{--                        <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Sign out</a>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
{{--        <footer class="bg-white">--}}
{{--            <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">--}}
{{--                <div class="flex justify-center md:order-2">--}}
{{--                    --}}{{--                    <a href="#" class="text-gray-400 hover:text-gray-500">--}}
{{--                    --}}{{--                        <span class="sr-only">Facebook</span>--}}
{{--                    --}}{{--                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                    --}}{{--                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/>--}}
{{--                    --}}{{--                        </svg>--}}
{{--                    --}}{{--                    </a>--}}
{{--                    --}}{{--                    <a href="#" class="ml-6 text-gray-400 hover:text-gray-500">--}}
{{--                    --}}{{--                        <span class="sr-only">Instagram</span>--}}
{{--                    --}}{{--                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                    --}}{{--                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/>--}}
{{--                    --}}{{--                        </svg>--}}
{{--                    --}}{{--                    </a>--}}
{{--                    <a href="https://twitter.com/atymic" class="ml-6 text-gray-400 hover:text-gray-500">--}}
{{--                        <span class="sr-only">Twitter</span>--}}
{{--                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>--}}
{{--                        </svg>--}}
{{--                    </a>--}}
{{--                    --}}{{--                    <a href="#" class="ml-6 text-gray-400 hover:text-gray-500">--}}
{{--                    --}}{{--                        <span class="sr-only">GitHub</span>--}}
{{--                    --}}{{--                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                    --}}{{--                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/>--}}
{{--                    --}}{{--                        </svg>--}}
{{--                    --}}{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="mt-8 md:mt-0 md:order-1">--}}
{{--                    <p class="text-center text-base leading-6 text-gray-400">--}}
{{--                        &copy; {{ date('Y') }} {{ config('app.name') }} - All rights reserved.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </footer>--}}
    </div>





</div>
@stack('after-js')
</body>
</html>
