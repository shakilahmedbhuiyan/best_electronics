<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="all">
    {!! SEO::generate(true) !!}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/ico">

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

    <!-- Google tag (gtag.js) for merchant -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=GT-5MXLVKLC"></script>
    <script>
        window.dataLayer = window.dataLayer || []

        function gtag() {
            dataLayer.push(arguments)
        }

        gtag('js', new Date())

        gtag('config', 'GT-5MXLVKLC')
    </script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=alexandria:100,200,300,400,500,700,800,900" rel="stylesheet" />

    <!--Wireui Scripts -->
    <wireui:scripts />

    <!-- Styles -->
    @filamentStyles
    @vite('resources/css/app.css')
    @livewireStyles
    <!-- Meta Pixel Code -->
    <script>
        !function(f, b, e, v, n, t, s) {
            if (f.fbq) return
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            }
            if (!f._fbq) f._fbq = n
            n.push = n
            n.loaded = !0
            n.version = '2.0'
            n.queue = []
            t = b.createElement(e)
            t.async = !0
            t.src = v
            s = b.getElementsByTagName(e)[0]
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js')
        fbq('init', '1230542744779073')
        fbq('track', 'PageView')
    </script>
    <!-- End Meta Pixel Code -->

</head>

<body id="app" class="font-sans antialiased bg-gray-100 dark:bg-slate-800">
@livewire('guest.components.top-header')
@livewire('guest.components.nav')


<!-- Notifications -->
<x-notifications position="top-right" z-index="z-50" />
<!-- Notifications End -->

<!-- Page Content -->
<main>
    {{ $slot }}
</main>


@livewire('notifications')
@stack('modals')

<livewire:guest.components.footer />

@filamentScripts
@vite('resources/js/app.js')
@livewireScripts
@stack('scripts')

<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=1230542744779073&ev=PageView&noscript=1"
    /></noscript>
<!-- End Meta Pixel Code -->

</body>

</html>
