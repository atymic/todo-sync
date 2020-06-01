@extends('layouts.app')

@section('content')
    <div class="h-full bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                Sign in to setup syncing
            </h2>
            <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
                Or
                <a href="{{ route('about') }}"
                   class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    read about how the sync works
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <div class="flex justify-center">
                    <a href="{{ route('login.google') }}"><img src="{{ asset('img/google.png') }}"></a>
                </div>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm leading-5">
                            <span class="px-2 bg-white text-gray-500">
                              Permissions
                            </span>
                        </div>

                    </div>
                    <div class="mt-4 text-gray-600 leading-normal">
                        <p class="mb-2">
                            We only ask for the minimum required permissions to sync your reminders between google and
                            todoist (as well as log you into this setup tool).
                        </p>
                        <p>
                            You can revoke these permissions at any time from your google account.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
