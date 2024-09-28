<section id="footer" class="w-full flex justify-center items-center">
    <div class="bg-white drop-shadow-lg rounded-t-lg mx-2 mt-6 px-6 py-8 w-full">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 p-6 text-gray-700 order-last">

            <div class="flex flex-col justify-end items-center">
                <x-application-mark href="{{ route('index') }}" alt="{{ config('app.name') }}"
                            class="h-12 w-12 py-0 text-blue-800" fill="currentColor" />
                <h1 class="title font-bold leading-loose">
                    {{ __(config('app.name')) }}
                </h1>
                <h2 class="tegline text-md font-light">
                    {{ __($store['description']) }}
                </h2>

            </div>

            <div class="flex flex-row justify-center items-end space-x-6">

                <div class="w-1/2">
                    <h3 class="font-bold">Services
                    </h3>
                    <ul class="mt-2">

                        <li>
                            service 1
                        </li>
                        <li>
                            service 2
                        </li>
                        <li>
                            service 3
                        </li>
                        <li>
                            service 4
                        </li>

                    </ul>
                </div>
                <div class="w-1/2">
                    <h3 class="font-bold">Quick Links
                    </h3>
                    <ul class="mt-2">

                        <li>
                            <a href="#" class="navlink hover:font-bold">
                                Find Us
                            </a>
                        </li>
                        <li>
                            <a href="#" class="navlink hover:font-bold">
                                Delivery and Return
                            </a>
                        </li>
                        <li>
                            <a href="#" class="navlink hover:font-bold">
                                Privacy Policy
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="flex flex-col justify-start items-center">
                <h3 class="font-bold">Contact Us
                </h3>
                <ul class="mt-2">
                    <li>
                        <a href="#" class="navlink hover:font-bold">
                            <i class="fas fa-phone-alt"></i>
                            {!! $store['phone'] !!}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="navlink hover:font-bold">
                            <i class="fas fa-envelope"></i>
                            {!! $store['email'] !!}
                        </a>
                    </li>
                </ul>

            </div>

        </div>
    </div>
</section>
