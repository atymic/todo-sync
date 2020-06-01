@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-6">
        <div>
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Accounts</h3>
                        <p class="mt-1 text-sm leading-5 text-gray-600">
                            Control connections to your google and todoist accounts.
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow sm:rounded-md sm:overflow-hidden flex flex-col md:flex-row justify-center items-center bg-white">
                        <div class="px-4 py-5 bg-white sm:p-6 flex items-center">
                            <div class="flex items-center">
                                <svg class="h-16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                     focusable="false"
                                     style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                                     preserveAspectRatio="xMidYMid meet" viewBox="0 0 48 48">
                                    <path fill="#FFC107"
                                          d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/>
                                    <path fill="#FF3D00"
                                          d="M6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C16.318 4 9.656 8.337 6.306 14.691z"/>
                                    <path fill="#4CAF50"
                                          d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/>
                                    <path fill="#1976D2"
                                          d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/>
                                </svg>
                                <div class="flex justify-center">
                                    <div class="ml-4 flex items-center">
                                        <svg class="h-8 w-8 text-green-500" fill="currentColor"
                                             viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="text-center ml-2 text-gray-500 text-sm mt-2">
                                            Connected
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6 flex items-center">
                            <div class="flex items-center">
                                <svg class="w-40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                     focusable="false"
                                     style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                                     preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 130">
                                    <path d="M220.837 77.727a17.7 17.7 0 0 0 1.048 6.047a15.187 15.187 0 0 0 7.97 8.737c1.908.895 4.073 1.342 6.491 1.342c2.42 0 4.58-.443 6.491-1.342a15.349 15.349 0 0 0 4.89-3.58a15.373 15.373 0 0 0 3.076-5.16a17.792 17.792 0 0 0 1.04-6.048c0-2.08-.346-4.104-1.036-6.047a15.32 15.32 0 0 0-3.072-5.148a15.4 15.4 0 0 0-4.894-3.58a15.106 15.106 0 0 0-6.49-1.35c-2.411 0-4.58.455-6.491 1.35a15.199 15.199 0 0 0-7.966 8.728a17.802 17.802 0 0 0-1.049 6.047m-12.917.645c0-4.273.766-8.164 2.286-11.65a27.245 27.245 0 0 1 6.185-8.959a27.22 27.22 0 0 1 9.232-5.749A31.941 31.941 0 0 1 237 49.986c4.003 0 7.792.678 11.356 2.024a27.434 27.434 0 0 1 9.249 5.75a27.346 27.346 0 0 1 6.18 8.95c1.52 3.494 2.282 7.377 2.282 11.662c0 4.286-.766 8.172-2.282 11.663a27.22 27.22 0 0 1-6.18 8.95a27.257 27.257 0 0 1-9.245 5.745a31.667 31.667 0 0 1-11.352 2.024a31.752 31.752 0 0 1-11.37-2.024a27.08 27.08 0 0 1-9.231-5.74a27.124 27.124 0 0 1-6.18-8.95c-1.52-3.496-2.282-7.378-2.282-11.664m77.485-.649c0 2.097.347 4.112 1.048 6.047a15.168 15.168 0 0 0 3.072 5.16a15.387 15.387 0 0 0 4.894 3.577c1.907.895 4.072 1.342 6.491 1.342c2.419 0 4.58-.443 6.49-1.342c1.896-.887 3.532-2.085 4.887-3.58a15.383 15.383 0 0 0 3.08-5.16a17.986 17.986 0 0 0 1.036-6.048c0-2.08-.35-4.104-1.04-6.047a15.344 15.344 0 0 0-3.08-5.148a15.247 15.247 0 0 0-4.89-3.58a15.106 15.106 0 0 0-6.491-1.35c-2.419 0-4.58.455-6.49 1.35a15.19 15.19 0 0 0-7.967 8.728a17.705 17.705 0 0 0-1.048 6.047l.008.004zm32.413 18.424h-.226c-1.947 3.258-4.555 5.624-7.853 7.104a25.879 25.879 0 0 1-10.66 2.21c-4.192 0-7.909-.715-11.166-2.158a25.056 25.056 0 0 1-8.362-5.934a25.358 25.358 0 0 1-5.281-8.87a32.824 32.824 0 0 1-1.786-10.965c0-3.919.629-7.58 1.91-10.982a26.97 26.97 0 0 1 5.322-8.87a24.48 24.48 0 0 1 8.245-5.926c3.225-1.451 6.74-2.169 10.546-2.169c2.552 0 4.798.262 6.745.774c1.947.525 3.66 1.182 5.16 2.004a19.593 19.593 0 0 1 6.398 5.318h.335V28.37c0-1.33 1.064-2.895 2.935-2.895h7.611c1.758 0 2.927 1.46 2.927 2.895v72.865c0 1.854-1.588 2.903-2.927 2.903h-6.93a2.955 2.955 0 0 1-2.943-2.903V96.15zm34.752-18.424c0 2.097.354 4.112 1.048 6.047a15.262 15.262 0 0 0 3.084 5.16a15.254 15.254 0 0 0 4.894 3.577c1.895.895 4.072 1.342 6.483 1.342c2.419 0 4.58-.443 6.49-1.342a15.26 15.26 0 0 0 4.89-3.58a15.383 15.383 0 0 0 3.08-5.16a17.986 17.986 0 0 0 1.037-6.048c0-2.08-.343-4.104-1.032-6.047a15.4 15.4 0 0 0-3.076-5.148a15.291 15.291 0 0 0-4.89-3.58a15.106 15.106 0 0 0-6.491-1.35c-2.411 0-4.58.455-6.483 1.35a15.223 15.223 0 0 0-7.978 8.728a17.9 17.9 0 0 0-1.048 6.047m-12.913.645c0-4.273.766-8.164 2.286-11.65a27.116 27.116 0 0 1 6.18-8.959a27.22 27.22 0 0 1 9.232-5.749a31.941 31.941 0 0 1 11.369-2.024c4.003 0 7.793.678 11.353 2.024a27.374 27.374 0 0 1 9.244 5.75a27.285 27.285 0 0 1 6.18 8.95c1.52 3.494 2.282 7.377 2.282 11.662c0 4.286-.766 8.172-2.286 11.663a27.293 27.293 0 0 1-6.184 8.95a27.217 27.217 0 0 1-9.244 5.745a31.667 31.667 0 0 1-11.353 2.024a31.752 31.752 0 0 1-11.369-2.024a27.08 27.08 0 0 1-9.232-5.74a27.124 27.124 0 0 1-6.18-8.95c-1.524-3.496-2.286-7.378-2.286-11.664M404.27 31.93c0-2.08.782-3.882 2.339-5.43c1.572-1.54 3.547-2.31 5.946-2.31c2.399 0 4.419.734 6.047 2.205c1.637 1.468 2.46 3.314 2.46 5.535c0 2.218-.823 4.072-2.46 5.536c-1.628 1.471-3.648 2.205-6.047 2.205c-2.395 0-4.37-.766-5.942-2.318c-1.565-1.54-2.347-3.346-2.347-5.423m55.466 34.39c-1.33 0-2.298-1.017-2.472-1.46c-1.104-2.943-4.628-4.052-7.474-4.052c-4.487 0-8.007 2.113-8.007 5.745c0 3.515 3.407 4.233 5.511 4.878c2.306.714 6.721 1.693 9.152 2.274a29.163 29.163 0 0 1 6.934 2.592c7.055 3.725 8.063 9.587 8.063 13.119c0 13.013-12.7 17.335-21.512 17.335c-6.797 0-19.565-1.048-22.367-14.211c-.274-1.278.847-3.25 2.895-3.25h7.337c1.452 0 2.42 1.069 2.701 1.907c.952 2.65 3.951 4.645 9.007 4.645c5.426 0 8.635-2.185 8.635-5.092c0-1.879-1.048-3.556-2.419-4.495c-4.112-2.838-14.291-3.157-19.815-6.144c-2.116-1.141-7.426-3.757-7.426-12.667c0-12.276 10.99-17.456 20.642-17.456c14.239 0 19.464 9.139 20.052 12.525c.323 1.871-.705 3.806-2.773 3.806h-6.672h.008zm13.001-7.358v-5.544c0-1.33 1.06-2.914 2.943-2.914h7.249V36.888c0-1.46 1.008-2.346 1.762-2.673c.443-.193 4.507-1.935 7.74-3.334c2.27-.915 4.1.928 4.1 2.693v16.933h12.002c1.854 0 2.955 1.588 2.955 2.91v5.552c0 1.612-1.46 2.923-2.955 2.923h-12.006v23.463c0 2.685-.08 4.781.968 6.33c.947 1.422 2.346 1.946 5.148 1.946c.798 0 1.516-.133 2.12-.334c1.774-.605 3.105.423 3.56 1.29c.88 1.681 1.895 3.536 2.605 4.866a2.963 2.963 0 0 1-1.274 4.007c-2.298 1.105-5.491 2-9.865 2c-3.629 0-5.677-.391-7.97-1.17a13.695 13.695 0 0 1-5.806-4.047c-1.33-1.596-1.992-3.741-2.48-6.128c-.495-2.378-.612-5.269-.612-8.401V61.887h-7.233c-1.895 0-2.955-1.62-2.955-2.93m-306.148.004v-5.544c0-1.33 1.032-2.914 2.863-2.914h8.07V36.888c0-1.46.976-2.346 1.718-2.673c.436-.193 4.387-1.935 7.54-3.334c2.208-.915 3.99.928 3.99 2.693v16.933h11.692c1.806 0 2.882 1.588 2.882 2.91v5.552c0 1.612-1.423 2.923-2.878 2.923h-11.692v23.463c0 2.685-.08 4.781.928 6.33c.927 1.422 2.298 1.946 5.023 1.946c.782 0 1.48-.133 2.072-.334a2.8 2.8 0 0 1 3.467 1.29c.859 1.681 1.847 3.536 2.54 4.866c.758 1.451.145 3.326-1.25 4.007c-2.237 1.105-5.342 2-9.595 2c-3.535 0-5.535-.391-7.768-1.17a13.356 13.356 0 0 1-5.66-4.047c-1.299-1.596-1.936-3.741-2.42-6.128c-.483-2.378-.596-5.269-.596-8.401V61.887h-8.051c-1.855 0-2.883-1.62-2.883-2.93m243.092 45.217h7.297c1.548 0 2.81-1.29 2.81-2.875V54.155a2.85 2.85 0 0 0-2.806-2.874h-7.297a2.846 2.846 0 0 0-2.814 2.874V101.3c0 1.58 1.257 2.875 2.805 2.875"
                                          fill="#E44332"/>
                                    <path d="M113.031 0H16.146C7.245.02.031 7.225 0 16.126v96.756c0 8.87 7.265 16.126 16.146 16.126h96.885c8.881 0 16.146-7.257 16.146-16.126V16.126c0-8.87-7.265-16.126-16.146-16.126"
                                          fill="#E44332"/>
                                    <path d="M27.382 61.105c2.258-1.318 50.756-29.502 51.865-30.155c1.109-.645 1.17-2.629-.08-3.346c-1.242-.714-3.6-2.069-4.475-2.589a4.06 4.06 0 0 0-4 .049c-.62.363-42.06 24.43-43.443 25.22c-1.665.952-3.71.968-5.362 0L0 37.442v10.917c5.322 3.136 18.573 10.925 21.782 12.76c1.915 1.088 3.75 1.064 5.604-.013"
                                          fill="#FFF"/>
                                    <path d="M27.382 81.747c2.258-1.319 50.756-29.503 51.865-30.156c1.109-.645 1.17-2.628-.08-3.346c-1.242-.714-3.6-2.068-4.475-2.588a4.06 4.06 0 0 0-4 .048c-.62.363-42.06 24.43-43.443 25.221c-1.665.952-3.71.968-5.362 0L0 58.082v10.917c5.322 3.137 18.573 10.925 21.782 12.76c1.915 1.088 3.75 1.064 5.604-.012"
                                          fill="#FFF"/>
                                    <path d="M27.382 103.678c2.258-1.318 50.756-29.503 51.865-30.156c1.109-.645 1.17-2.628-.08-3.346c-1.242-.713-3.6-2.068-4.475-2.588a4.06 4.06 0 0 0-4 .048c-.62.363-42.06 24.431-43.443 25.221c-1.665.952-3.71.968-5.362 0L0 80.013V90.93c5.322 3.137 18.573 10.926 21.782 12.76c1.915 1.089 3.75 1.064 5.604-.012"
                                          fill="#FFF"/>
                                </svg>
                                <div class="ml-4 flex items-center">
                                    @if($user->todoist_id)
                                        <svg class="h-8 w-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="text-center text-gray-500 text-sm ml-2 mt-2">
                                            Connected
                                        </div>
                                    @else
                                        <span class="inline-flex rounded-md shadow-sm ml-2">
                                              <a href="{{ route('login.todoist') }}"
                                                 class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                                Connect
                                                <svg class="ml-2 -mr-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                                                </svg>
                                              </a>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden sm:block">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Sync Settings</h3>
                            <p class="mt-1 text-sm leading-5 text-gray-600">
                                Configure the sync settings between google reminders and todoist
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action="{{ route('settings.update') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="shadow overflow-hidden sm:rounded-md {{ !$user->setup ? 'opacity-50 pointer-events-none' : '' }}">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div>
                                        <legend class="text-base leading-6 font-medium text-gray-900 mb-2">Enable /
                                            Disable Synchronization
                                        </legend>
                                        <span class="inline-flex rounded-md shadow-sm">
                                          @if($user->sync_enabled)
                                                <a href="{{ route('settings.toggle') }}"
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150">
                                                        Disable Sync
                                                    </a>
                                            @else
                                                <a href="{{ route('settings.toggle') }}"
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition ease-in-out duration-150">
                                                        Enable Sync
                                                    </a>
                                            @endif
                                        </span>
                                    </div>
                                    <fieldset class="mt-4">
                                        <legend class="text-base leading-6 font-medium text-gray-900">Todoist Settings
                                        </legend>
                                        <div class="mt-4">
                                            <div class="flex items-start">
                                                <div class="absolute flex items-center h-5">
                                                    <input id="todoist_disable_reminders" value="1"
                                                           name="todoist_disable_reminders" type="checkbox"
                                                           {{ $user->todoist_disable_reminders ? 'checked' : '' }} class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"/>
                                                </div>
                                                <div class="pl-7 text-sm leading-5">
                                                    <label for="todoist_disable_reminders"
                                                           class="font-medium text-gray-700">Don't set reminders</label>
                                                    <p class="text-gray-500">Disable todoist reminders for synced
                                                        tasks.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="mt-6">
                                        <legend class="text-base leading-6 font-medium text-gray-900">Google Reminders
                                        </legend>
                                        <p class="text-sm leading-5 text-gray-500">You can choose to have the google
                                            reminders removed immediately, after the reminder time, or never.</p>
                                        <div class="mt-4">
                                            <div class="flex items-center">
                                                <input id="{{ \App\Enums\GoogleRemoveSetting::IMMEDIATE }}"
                                                       name="google_reminders"
                                                       value="{{ \App\Enums\GoogleRemoveSetting::IMMEDIATE }}"
                                                       {{ $user->google_reminders === \App\Enums\GoogleRemoveSetting::IMMEDIATE ? 'checked' : '' }}
                                                       type="radio"
                                                       class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"/>
                                                <label for="{{ \App\Enums\GoogleRemoveSetting::IMMEDIATE }}"
                                                       class="ml-3">
                                                    <span class="block text-sm leading-5 text-gray-700"><span
                                                                class="font-medium">Remove Immediately</span> <span
                                                                class="text-gray-500">(you won't be reminded by google, todoist will handle reminders)</span></span>
                                                </label>
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <input id="{{ \App\Enums\GoogleRemoveSetting::AFTER_TIME }}"
                                                       name="google_reminders" type="radio"
                                                       value="{{ \App\Enums\GoogleRemoveSetting::AFTER_TIME }}"
                                                       {{ $user->google_reminders === \App\Enums\GoogleRemoveSetting::AFTER_TIME ? 'checked' : '' }}
                                                       class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"/>
                                                <label for="{{ \App\Enums\GoogleRemoveSetting::AFTER_TIME }}"
                                                       class="ml-3">
                                                    <span class="block text-sm leading-5 text-gray-700"><span
                                                                class="font-medium">Remove After Reminder Time</span> <span
                                                                class="text-gray-500">(you'll be reminded by both services)</span></span>
                                                </label>
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <input id="{{ \App\Enums\GoogleRemoveSetting::NEVER }}"
                                                       name="google_reminders"
                                                       value="{{ \App\Enums\GoogleRemoveSetting::NEVER }}"
                                                       {{ $user->google_reminders === \App\Enums\GoogleRemoveSetting::NEVER ? 'checked' : '' }}
                                                       type="radio"
                                                       class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"/>
                                                <label for="{{ \App\Enums\GoogleRemoveSetting::NEVER }}" class="ml-3">
                                                    <span class="block text-sm leading-5 text-gray-700"><span
                                                                class="font-medium">Leave</span> <span
                                                                class="text-gray-500">(we won't delete the google reminders)</span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
