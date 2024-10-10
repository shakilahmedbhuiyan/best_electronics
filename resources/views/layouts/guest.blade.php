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
    <script async src="https://www.googletagmanager.com/gtag/js?id=GT-5MXLVKLC"></script>
    <script>
        window.dataLayer = window.dataLayer || []

        function gtag() {
            dataLayer.push(arguments)
        }

        gtag('js', new Date())

        gtag('config', 'G-6MZMNHZ157')

   // - Google tag (gtag.js) for merchant

        gtag('config', 'GT-5MXLVKLC')
    </script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.google.com">

    <!--Wireui Scripts -->
    <wireui:scripts />

    <!-- Styles -->
    @vite('resources/css/app.css')
    @livewireStyles

    @stack('styles')
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

<body id="app" class="font-sans antialiased bg-gray-100 dark:bg-slate-800 relative">
<!-- Notifications -->
<x-notifications  z-index="z-50" />

@livewire('guest.components.top-header')
@livewire('guest.components.nav')



<!-- Notifications End -->

<!-- Page Content -->
<main>
    {{ $slot }}
</main>

<!-- BUY ME A BEER AND HELP SUPPORT OPEN-SOURCE RESOURCES -->
<div class="flex items-end justify-end fixed bottom-0 sm:bottom-6 right-0 mb-8 mr-4 z-10">
    <div>
        <a title="Whatsapp Contact" href="{{ "https://wa.me/". $store['whatsapp'] }}"
           target="_blank" rel="help"
           class="block w-12 h-12 rounded-full transition-all shadow hover:shadow-lg
           transform hover:scale-105 hover:rotate-12">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" class="h-12 w-12 drop-shadow"
                 viewBox="0 0 512 512" xml:space="preserve">
                <path style="fill:#EDEDED;" d="M0,512l35.31-128C12.359,344.276,0,300.138,0,254.234C0,114.759,114.759,0,255.117,0
	S512,114.759,512,254.234S395.476,512,255.117,512c-44.138,0-86.51-14.124-124.469-35.31L0,512z" />
                <path style="fill:#21a23c;" d="M137.71,430.786l7.945,4.414c32.662,20.303,70.621,32.662,110.345,32.662
	c115.641,0,211.862-96.221,211.862-213.628S371.641,44.138,255.117,44.138S44.138,137.71,44.138,254.234
	c0,40.607,11.476,80.331,32.662,113.876l5.297,7.945l-20.303,74.152L137.71,430.786z" />
                <path style="fill:#FEFEFE;" d="M187.145,135.945l-16.772-0.883c-5.297,0-10.593,1.766-14.124,5.297
	c-7.945,7.062-21.186,20.303-24.717,37.959c-6.179,26.483,3.531,58.262,26.483,90.041s67.09,82.979,144.772,105.048
	c24.717,7.062,44.138,2.648,60.028-7.062c12.359-7.945,20.303-20.303,22.952-33.545l2.648-12.359
	c0.883-3.531-0.883-7.945-4.414-9.71l-55.614-25.6c-3.531-1.766-7.945-0.883-10.593,2.648l-22.069,28.248
	c-1.766,1.766-4.414,2.648-7.062,1.766c-15.007-5.297-65.324-26.483-92.69-79.448c-0.883-2.648-0.883-5.297,0.883-7.062
	l21.186-23.834c1.766-2.648,2.648-6.179,1.766-8.828l-25.6-57.379C193.324,138.593,190.676,135.945,187.145,135.945" />
            </svg>
        </a>
    </div>
</div>


@livewire('notifications')
@stack('modals')

<livewire:guest.components.footer />

@vite('resources/js/app.js')
@livewireScripts
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js" async defer></script>
@stack('scripts')

<noscript>
    <img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=1230542744779073&ev=PageView&noscript=1"
    /></noscript>
<!-- End Meta Pixel Code -->

</body>

</html>
