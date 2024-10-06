<footer class="px-4 divide-y bg-gradient-to-br sm:bg-gradient-to-bl from-emerald-800 to-emerald-950 text-gray-100">
    <div class="container flex flex-col justify-between py-10 print:py-1 mx-auto space-y-8 lg:flex-row lg:space-y-0"
         bis_skin_checked="1">
        <div class="lg:w-1/3" bis_skin_checked="1">
            <a rel="noopener noreferrer" href="{{ route('index') }}" alt="{{ config('app.name') }}"
               class="inline-flex justify-center items-center leading-none">

                <x-application-mark class="h-12 w-12 py-0" />

                <span class="self-center text-2xl font-semibold">
                    {!! config('app.name') !!}
                </span>
                <h2 class="text-sm font-light">
                    {{ __($store['description']) }}
                </h2>
            </a>
        </div>
        <div class="grid grid-cols-2 text-sm gap-x-3 gap-y-8 lg:w-2/3 sm:grid-cols-4 print:hidden"
             bis_skin_checked="1">
            <div class="space-y-3" bis_skin_checked="1">
                <h3 class="tracking-wide uppercase text-gray-50 ">Product</h3>
                <ul class="space-y-1">
                    <li>
                        <a rel="noopener noreferrer" href="#">Features</a>
                    </li>
                    <li>
                        <a rel="noopener noreferrer" href="#">Brands</a>
                    </li>
                    <li>
                        <a rel="noopener noreferrer" href="#">Categories</a>
                    </li>
                </ul>
            </div>
            <div class="space-y-3" bis_skin_checked="1">
                <h3 class="tracking-wide uppercase text-gray-50 ">Company</h3>
                <ul class="space-y-1">
                    <li>
                        <a rel="noopener noreferrer" href="#">About US</a>
                    </li>
                    <li>
                        <a rel="noopener noreferrer" href="#">FAQ</a>
                    </li>
                    <li>
                        <a rel="next" href="{{ route('pay-later') }}" wire:navigate>Pay Later</a>
                    </li>

                </ul>
            </div>
            <div class="space-y-3" bis_skin_checked="1">
                <h3 class="uppercase text-gray-50 ">Quick Links</h3>
                <ul class="space-y-1">
                    <li>
                        <a rel="noopener noreferrer" href="#">Privacy Policy</a>
                    </li>
                    <li>
                        <a rel="noopener noreferrer" href="#">Terms of Service</a>
                    </li>
                    <li>
                        <a rel="noopener noreferrer" href="#">Return and Refund</a>
                    </li>
                </ul>
            </div>
            <div class="space-y-3" bis_skin_checked="1">
                <div class="uppercase text-gray-50 " bis_skin_checked="1">Social media</div>
                <div class="flex justify-start space-x-3" bis_skin_checked="1">
                    <a rel="noopener noreferrer" href="https://facebook.com/bestelectronicsksa"
                       title="Facebook" class="flex items-center p-1" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 32 32"
                             class="w-5 h-5 fill-current">
                            <path
                                d="M32 16c0-8.839-7.167-16-16-16-8.839 0-16 7.161-16 16 0 7.984 5.849 14.604 13.5 15.803v-11.177h-4.063v-4.625h4.063v-3.527c0-4.009 2.385-6.223 6.041-6.223 1.751 0 3.584 0.312 3.584 0.312v3.937h-2.021c-1.984 0-2.604 1.235-2.604 2.5v3h4.437l-0.713 4.625h-3.724v11.177c7.645-1.199 13.5-7.819 13.5-15.803z"></path>
                        </svg>
                    </a>
                    <a rel="noopener noreferrer" href="#" title="youtube" class="flex items-center p-1">
                        <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd"
                                  d="M15.32 4.06c-.434-.772-.905-.914-1.864-.968C12.498 3.027 10.089 3 8.002 3c-2.091 0-4.501.027-5.458.091-.957.055-1.429.196-1.867.969C.23 4.831 0 6.159 0 8.497v.008c0 2.328.23 3.666.677 4.429.438.772.909.912 1.866.977.958.056 3.368.089 5.459.089 2.087 0 4.496-.033 5.455-.088.959-.065 1.43-.205 1.864-.977.451-.763.679-2.101.679-4.429v-.008c0-2.339-.228-3.667-.68-4.438zM6 11.5v-6l5 3-5 3z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a rel="noopener noreferrer" href="#" title="tiktok" class="flex items-center p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" class="w-5 h-5 fill-current"
                             clip-rule="evenodd" image-rendering="optimizeQuality" shape-rendering="geometricPrecision"
                             text-rendering="geometricPrecision" viewBox="0 0 512 512" id="tiktok">
                            <path
                                d="M353.97 0.43c0.03,7.81 2.31,120.68 120.76,127.72 0,32.55 0.04,56.15 0.04,87.21 -8.97,0.52 -77.98,-4.49 -120.93,-42.8l-0.13 169.78c1.63,117.84 -85.09,189.55 -198.44,164.78 -195.46,-58.47 -130.51,-348.37 65.75,-317.34 0,93.59 0.05,-0.03 0.05,93.59 -81.08,-11.93 -108.2,55.52 -86.65,103.81 19.6,43.97 100.33,53.5 128.49,-8.53 3.19,-12.14 4.78,-25.98 4.78,-41.52l0 -337.13 86.28 0.43z"></path>
                        </svg>
                    </a>
                    <a rel="noopener noreferrer" href="#" title="Instagram" class="flex items-center p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor"
                             class="w-5 h-5 fill-current">
                            <path
                                d="M16 0c-4.349 0-4.891 0.021-6.593 0.093-1.709 0.084-2.865 0.349-3.885 0.745-1.052 0.412-1.948 0.959-2.833 1.849-0.891 0.885-1.443 1.781-1.849 2.833-0.396 1.020-0.661 2.176-0.745 3.885-0.077 1.703-0.093 2.244-0.093 6.593s0.021 4.891 0.093 6.593c0.084 1.704 0.349 2.865 0.745 3.885 0.412 1.052 0.959 1.948 1.849 2.833 0.885 0.891 1.781 1.443 2.833 1.849 1.020 0.391 2.181 0.661 3.885 0.745 1.703 0.077 2.244 0.093 6.593 0.093s4.891-0.021 6.593-0.093c1.704-0.084 2.865-0.355 3.885-0.745 1.052-0.412 1.948-0.959 2.833-1.849 0.891-0.885 1.443-1.776 1.849-2.833 0.391-1.020 0.661-2.181 0.745-3.885 0.077-1.703 0.093-2.244 0.093-6.593s-0.021-4.891-0.093-6.593c-0.084-1.704-0.355-2.871-0.745-3.885-0.412-1.052-0.959-1.948-1.849-2.833-0.885-0.891-1.776-1.443-2.833-1.849-1.020-0.396-2.181-0.661-3.885-0.745-1.703-0.077-2.244-0.093-6.593-0.093zM16 2.88c4.271 0 4.781 0.021 6.469 0.093 1.557 0.073 2.405 0.333 2.968 0.553 0.751 0.291 1.276 0.635 1.844 1.197 0.557 0.557 0.901 1.088 1.192 1.839 0.22 0.563 0.48 1.411 0.553 2.968 0.072 1.688 0.093 2.199 0.093 6.469s-0.021 4.781-0.099 6.469c-0.084 1.557-0.344 2.405-0.563 2.968-0.303 0.751-0.641 1.276-1.199 1.844-0.563 0.557-1.099 0.901-1.844 1.192-0.556 0.22-1.416 0.48-2.979 0.553-1.697 0.072-2.197 0.093-6.479 0.093s-4.781-0.021-6.48-0.099c-1.557-0.084-2.416-0.344-2.979-0.563-0.76-0.303-1.281-0.641-1.839-1.199-0.563-0.563-0.921-1.099-1.197-1.844-0.224-0.556-0.48-1.416-0.563-2.979-0.057-1.677-0.084-2.197-0.084-6.459 0-4.26 0.027-4.781 0.084-6.479 0.083-1.563 0.339-2.421 0.563-2.979 0.276-0.761 0.635-1.281 1.197-1.844 0.557-0.557 1.079-0.917 1.839-1.199 0.563-0.219 1.401-0.479 2.964-0.557 1.697-0.061 2.197-0.083 6.473-0.083zM16 7.787c-4.541 0-8.213 3.677-8.213 8.213 0 4.541 3.677 8.213 8.213 8.213 4.541 0 8.213-3.677 8.213-8.213 0-4.541-3.677-8.213-8.213-8.213zM16 21.333c-2.948 0-5.333-2.385-5.333-5.333s2.385-5.333 5.333-5.333c2.948 0 5.333 2.385 5.333 5.333s-2.385 5.333-5.333 5.333zM26.464 7.459c0 1.063-0.865 1.921-1.923 1.921-1.063 0-1.921-0.859-1.921-1.921 0-1.057 0.864-1.917 1.921-1.917s1.923 0.86 1.923 1.917z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6 print:py-0 text-sm text-center text-gray-400 flex flex-col sm:flex-row
	justify-center sm:justify-between items-center" bis_skin_checked="1">
        <span>
            © {{ date('Y'). ' '. config('app.name') }} All rights reserved.
        </span>
        <div class="pl-1 flex flex-row justify-center items-center space-x-1">
            <span>Developed by</span>
            <a href="https://retrievalit.xyz" target="_blank"
               class="flex flex-row items-center hover:text-blue-600 space-x-0.5"
               bis_skin_checked="1">
                <svg id="uuid-e0462990-7840-4306-925f-6d3339cc2c47" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 1192.16 1192.16"
                     class="h-5 w-5">
                    <g id="uuid-e48b95eb-6b11-4386-8fc6-f92d3a318746">
                        <path
                            d="M1192.16,596.08c0,60.49-9.01,118.87-25.76,173.88-3.22,8.7-8.13,20.54-15.41,33.88-17.78,32.58-38.14,52.98-52.47,67.12-12.5,12.33-34.86,34.08-70.17,53.08-12.95,6.97-24.42,11.84-33.05,15.14-43.83,16.25-90.01,24.48-137.53,24.48-53.56,0-105.41-10.45-154.11-31.05-47.14-19.94-89.52-48.52-125.96-84.96-12.41-12.41-23.91-25.51-34.46-39.25,17.08,3.41,34.75,5.2,52.84,5.2,148.36,0,268.63-120.27,268.63-268.63s-120.27-268.63-268.63-268.63c-2.29,0-4.58,.03-6.85,.09-7.64,.19-15.2,.7-22.67,1.52-59.43,6.49-113.03,32.37-154.34,71.18-23.76,22.31-43.46,48.89-57.86,78.53l23.94,11.97,58.58,29.29,6.99,3.5c11.59-24.22,28.79-45.26,49.92-61.42h0c28.39-21.74,63.86-34.66,102.29-34.66,92.98,0,168.63,75.65,168.63,168.63s-75.65,168.63-168.63,168.63h-168.63v-168.28h-99.92v474.71h99.92v-205.36c21.7,37.75,48.32,72.47,79.54,103.69,45.59,45.59,98.65,81.37,157.71,106.35,61.1,25.84,126.05,38.95,193.07,38.95,43.77,0,86.66-5.59,128.17-16.68-104.52,90.46-240.8,145.17-389.86,145.17C266.87,1192.16,0,925.29,0,596.08S266.87,0,596.08,0s596.08,266.88,596.08,596.08Z"
                            style="fill:currentColor;">
                        </path>
                    </g>
                </svg>
                <span>Retrieval IT</span></a>
        </div>

    </div>
</footer>
