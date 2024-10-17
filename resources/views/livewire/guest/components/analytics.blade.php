<analytics>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6MZMNHZ157" data-navigate-track="reload"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=GT-5MXLVKLC" data-navigate-track="reload"></script>
    <script data-navigate-track="reload">
        window.dataLayer = window.dataLayer || []

        function gtag() {
            dataLayer.push(arguments)
        }

        gtag('js', new Date())

        gtag('config', 'G-6MZMNHZ157')

        // - Google tag (gtag.js) for merchant

        gtag('config', 'GT-5MXLVKLC')
    </script>


    <!-- Meta Pixel Code -->
    <script data-navigate-track="reload">
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

</analytics>
