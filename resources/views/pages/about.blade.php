@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-6">

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
                <h3 class="text-2xl">About</h3>
            </div>
            <div class="px-4 py-5 sm:p-6 leading-normal">
                <p>
                    I built this tool after getting annoyed constantly at the horrible user experience of google reminders.
                    For something that exists across so many google products, it's inconsistent and hard to use.
                </p>
                <p class="mt-2">
                    Todoist, on the other hand, is an awesome service. One of the things that I've missed was being able
                    to yell tasks at my google home/phone/whatever, so I built this to sync them across automatically 🎉
                </p>
                <h3 class="text-xl font-semibold mt-6 text-gray-800">We're open source & don't save/share your data</h3>
                <p class="mt-2">
                    Check out the source code on <a href="https://github.com/atymic/todo-sync" target="_blank" class="text-indigo-600 font-semibold">Github</a>. Feel free to report issues there, or
                    help out and fix some bugs or add a new feature. We don't save or log any data that's not needed to sync the reminders.
                </p>
                <h3 class="text-xl font-semibold mt-6 text-gray-800">Who Built This?</h3>
                <p class="mt-2">
                    <span class="mr-1">👋</span> I'm <a href="https://atymic.dev" class="text-blue-500 font-semibold">atymic</a>, a seasoned
                    web developer &amp; open source contributor. You can check out my contributions on <a href="https://github.com/atymic" class="text-blue-500 ">GitHub</a>.
                    Want to get in touch, or have a question about the service? Send me an <a href="mailto:hello@atymic.dev" class="text-blue-500 font-semibold">email here</a>.
                </p>
            </div>
        </div>
    </div>
@endsection
