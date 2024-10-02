<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex/nofollow">
    <title>{{ ($title ?? SEOMeta::getTitle()) . ' | ' . config('app.name') }}</title>
    <meta name="description" content="{{ SEOMeta::getDescription() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <wireui:scripts />

    <!-- Styles -->
    @filamentStyles
    @vite('resources/css/app.css')
    @livewireStyles
    @stack('styles')

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6MZMNHZ157"></script>
    <script>
        window.dataLayer = window.dataLayer || []

        function gtag() {
            dataLayer.push(arguments)
        }

        gtag('js', new Date())

        gtag('config', 'G-6MZMNHZ157')
    </script>

</head>

<body id="app" class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
<x-banner />

<div class="flex flex-row relative" x-data="{ sidebar: false, mobile: false }"
     x-init="width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
                 sidebar = (width < 640) ? false : true;"
     @resize.window="width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
                       sidebar = (width < 640) ? false : true">

    @livewire('dash.components.nav')
    @livewire('dash.components.sidebar')

    <div :class="{ 'ml-60': sidebar, 'ml-0': !sidebar }"
         class="min-h-screen p-4 w-full mt-14 transition-all duration-300 ease-in-out">
        <!-- Page Heading -->
        @if (isset($header) || isset($title))
            <header class="bg-white dark:bg-slate-800 drop-shadow backdrop-blur-lg rounded-md">
                <div
                    class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between
                    items-center">
                    <h2 class="text-xl font-bold text-blue-800 dark:text-blue-200 tracking-widest">
                        {{ $header?? $title }}
                    </h2>
                    @isset($button)
                        <div class="w-full sm:w-1/2 flex flex-col sm:flex-row justify-end">
                            {{ $button }}
                        </div>
                    @endisset
                </div>
            </header>
        @endif
        <x-notifications position="top-right" z-index="z-50" />
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @livewire('notifications')
    @stack('modals')
</div>

@filamentScripts
@vite('resources/js/app.js')
@livewireScripts
@stack('scripts')
</body>

</html>
