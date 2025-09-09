<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-10 sm:pt-0 bg-gradient-to-br from-indigo-50 via-white to-sky-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800">
            <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                <div class="absolute -top-24 -left-20 h-72 w-72 rounded-full bg-gradient-to-tr from-indigo-400/30 to-sky-300/30 blur-3xl"></div>
                <div class="absolute -bottom-24 -right-20 h-80 w-80 rounded-full bg-gradient-to-tr from-fuchsia-300/20 to-indigo-400/20 blur-3xl"></div>
            </div>

            <div class="flex items-center gap-3 mt-6">
                <a href="/" wire:navigate class="flex items-center gap-3">
                    <x-application-logo class="w-10 h-10" />
                    <span class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ config('app.name', 'Todo App') }}</span>
                </a>
            </div>

            <div class="w-full sm:max-w-lg mt-8 px-8 py-6 bg-white/90 dark:bg-gray-800/90 shadow-xl ring-1 ring-black/5 overflow-hidden sm:rounded-2xl backdrop-blur">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
