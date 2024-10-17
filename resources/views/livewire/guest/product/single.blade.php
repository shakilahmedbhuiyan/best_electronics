<section>
    <!-- ✅ Product Details - Starts Here 👇 -->
    <div class="font-sans my-6 px-5 text-gray-800 dark:text-gray-200">
        <div class="p-4 w-full max-lg:mx-auto">
            <div class="grid items-start grid-cols-1 lg:grid-cols-2 gap-8 max-lg:gap-16">
                <div class="w-full lg:sticky top-0 text-center">
                    <div class="sm:h-96 h-64 carousel carousel-main "
                         data-flickity='{"pageDots": false, "setGallerySize": false}'>
                        <img src="{{ asset($product['thumbnail']) }}" alt="{{ $product['name'] }}"
                             class="lg:w-11/12 w-full h-full aspect-square rounded-md object-contain carousel-cell carousel-cell-image" />
                        @if($product['images'])
                            @foreach($product['images'] as $i)
                                <img src="{{ asset($i['image']) }}" alt="{{ $product['name'].'-'.$i['variation'] }}"
                                     loading="lazy"
                                     class="lg:w-11/12 w-full h-full aspect-square rounded-md object-contain carousel-cell carousel-cell-image " />
                            @endforeach
                        @endif
                    </div>

                    @if($product['images'])
                        <div class="carousel carousel-nav content-center"
                             data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
                            <img src="{{ asset($product['thumbnail']) }}" alt="{{ $product['name'] }}"
                                 loading="lazy"
                                 class="w-24 h-24 aspect-square rounded-md object-contain carousel-cell " />
                            @foreach($product['images'] as $i)
                                <img src="{{ asset($i['image']) }}" alt="{{ $product['name'].'-'.$i['variation'] }}"
                                     loading="lazy"
                                     class="w-24 h-24 aspect-square rounded-md object-cover carousel-cell " />
                            @endforeach
                        </div>
                    @endif
                </div>

                <div>
                    <div class="flex flex-wrap items-start gap-4">
                        <div>
                            <h2 class="text-2xl font-bold capitalize">{{ $product['name'] }}</h2>
                            <div class="flex flex-row space-x-2 mt-2 justify-center items-center ">
                                <a class="text-sm text-gray-600 bg-green-300 rounded p-2"
                                   aria-label="{{ $product['brand']['name'].' brand' }}"
                                   href="{{ route('index.brand', $product['brand']['slug'] ) }}" wire:navigate>
                                    {{ $product['brand']['name'] }}</a>
                                <a class="text-sm text-gray-600 bg-green-300 rounded p-2"
                                   aria-label="{{ $product['category']['name'].' Category' }}"
                                   href="{{ route('index.category', $product['category']['slug'] ) }}" wire:navigate>
                                    {{ $product['category']['name'] }}</a>
                            </div>
                        </div>

                        <!-- share buttons -->
                        <div class="ml-auto flex flex-wrap gap-4">
                            <a href="{{'https://www.facebook.com/sharer/sharer.php?u='.url()->current()}}"
                               target="_blank" rel="noopener referrer" title="Share on Facebook" data-toggle="tooltip"
                               aria-label="Share on Facebook">
                                <x-mini-button rounded flat info type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"
                                         class="h-6 w-6">
                                        <path
                                            d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm8,191.63V152h24a8,8,0,0,0,0-16H136V112a16,16,0,0,1,16-16h16a8,8,0,0,0,0-16H152a32,32,0,0,0-32,32v24H96a8,8,0,0,0,0,16h24v63.63a88,88,0,1,1,16,0Z"></path>
                                    </svg>
                                </x-mini-button>
                            </a>
                            <a href="{{'https://wa.me/?text='.url()->current()}}"
                               target="_blank" rel="noopener referrer" title="Share on WhatsApp" data-toggle="tooltip"
                               aria-label="Share on WhatsApp">
                                <x-mini-button rounded flat primary type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"
                                         class="h-6 w-6">
                                            <path
                                                d="M187.58,144.84l-32-16a8,8,0,0,0-8,.5l-14.69,9.8a40.55,40.55,0,0,1-16-16l9.8-14.69a8,8,0,0,0,.5-8l-16-32A8,8,0,0,0,104,64a40,40,0,0,0-40,40,88.1,88.1,0,0,0,88,88,40,40,0,0,0,40-40A8,8,0,0,0,187.58,144.84ZM152,176a72.08,72.08,0,0,1-72-72A24,24,0,0,1,99.29,80.46l11.48,23L101,118a8,8,0,0,0-.73,7.51,56.47,56.47,0,0,0,30.15,30.15A8,8,0,0,0,138,155l14.61-9.74,23,11.48A24,24,0,0,1,152,176ZM128,24A104,104,0,0,0,36.18,176.88L24.83,210.93a16,16,0,0,0,20.24,20.24l34.05-11.35A104,104,0,1,0,128,24Zm0,192a87.87,87.87,0,0,1-44.06-11.81,8,8,0,0,0-6.54-.67L40,216,52.47,178.6a8,8,0,0,0-.66-6.54A88,88,0,1,1,128,216Z"></path>
                                        </svg>
                                </x-mini-button>
                            </a>
                        </div>
                    </div>

                    <hr class="my-8" />

                    <div class="flex flex-wrap gap-4 items-start">
                        <p class="text-sm text-gray-600 dark:text-gray-400 w-full text-justify capitalize whitespace-pre-line">
                            {!! $product['summary'] !!}
                        </p>
                        <div>

                            <p class="text-4xl font-bold">
                                {!! "SAR ". (isset($product['sale_price']) ? $product['sale_price'] : $product['price']) !!}
                            </p>
                            <p class="text-gray-700 dark:text-gray-400 mt-2">
                                @if($product['sale_price'] | $product['sale'] === 1)
                                    <del>{!! $product['price'] !!}</del>
                                @endif
                                <span class="ml-1">Tax included</span>
                            </p>
                            @if($product['instalment'])
                                <div
                                    class="text-md inline-flex justify-center items-center text-primary-800 dark:text-primary-500">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                         viewBox="0 0 48 48" fill="currentColor">
                                        <path
                                            d="M28,41H6c-1.1,0-2-.9-2-2v-22h34v5c0,.55.45,1,1,1s1-.45,1-1v-11c0-2.21-1.79-4-4-4h-2v-1c0-.55-.45-1-1-1s-1,.45-1,1v1h-4v-1c0-.55-.45-1-1-1s-1,.45-1,1v1h-4v-1c0-.55-.45-1-1-1s-1,.45-1,1v1h-4v-1c0-.55-.45-1-1-1s-1,.45-1,1v1h-4v-1c0-.55-.45-1-1-1s-1,.45-1,1v1h-2c-2.21,0-4,1.79-4,4v28c0,2.21,1.79,4,4,4h22c.55,0,1-.45,1-1s-.45-1-1-1ZM6,9h2v2c0,.55.45,1,1,1s1-.45,1-1v-2h4v2c0,.55.45,1,1,1s1-.45,1-1v-2h4v2c0,.55.45,1,1,1s1-.45,1-1v-2h4v2c0,.55.45,1,1,1s1-.45,1-1v-2h4v2c0,.55.45,1,1,1s1-.45,1-1v-2h2c1.1,0,2,.9,2,2v4H4v-4c0-1.1.9-2,2-2Z" />
                                        <path
                                            d="M37 25c-4.96 0-9 4.04-9 9s4.04 9 9 9 9-4.04 9-9-4.04-9-9-9zM37 41c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM14 22c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-4zM12 25h-2v-2h2v2zM13 31h-4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1zM12 35h-2v-2h2v2zM24 22c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-4zM22 25h-2v-2h2v2zM23 31h-4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1zM22 35h-2v-2h2v2zM29 21c-.55 0-1 .45-1 1v3.07c0 .55.45 1 1 1s1-.45 1-1v-2.07h2.05c.13.4.51.69.95.69.55 0 1-.45 1-1v-.69c0-.55-.45-1-1-1h-4z" />
                                        <path
                                            d="M39.29,30.29l-6,6c-.39.39-.39,1.02,0,1.41.2.2.45.29.71.29s.51-.1.71-.29l6-6c.39-.39.39-1.02,0-1.41s-1.02-.39-1.41,0Z" />
                                        <circle cx="34.5" cy="31.5" r="1.5" />
                                        <circle cx="39.5" cy="36.5" r="1.5" />
                                    </svg>
                                    <span> {{ __('Installment Available') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr class="my-8" />

                    <div>
                        {{--                        <h3 class="text-xl font-bold text-gray-800">Choose a Size</h3>--}}
                        {{--                        <div class="flex flex-wrap gap-4 mt-4">--}}
                        {{--                            <button type="button"--}}
                        {{--                                    class="w-10 h-10 border hover:border-gray-800 font-semibold text-sm rounded-md flex items-center justify-center shrink-0">--}}
                        {{--                                SM--}}
                        {{--                            </button>--}}
                        {{--                            <button type="button"--}}
                        {{--                                    class="w-10 h-10 border hover:border-gray-800 border-gray-800 font-semibold text-sm rounded-md flex items-center justify-center shrink-0">--}}
                        {{--                                MD--}}
                        {{--                            </button>--}}
                        {{--                            <button type="button"--}}
                        {{--                                    class="w-10 h-10 border hover:border-gray-800 font-semibold text-sm rounded-md flex items-center justify-center shrink-0">--}}
                        {{--                                LG--}}
                        {{--                            </button>--}}
                        {{--                            <button type="button"--}}
                        {{--                                    class="w-10 h-10 border hover:border-gray-800 font-semibold text-sm rounded-md flex items-center justify-center shrink-0">--}}
                        {{--                                XL--}}
                        {{--                            </button>--}}
                        {{--                        </div>--}}
                    </div>

                    {{--                    <hr class="my-8" />--}}

                    {{--                    <div>--}}
                    {{--                        <h3 class="text-xl font-bold text-gray-800">Choose a Color</h3>--}}
                    {{--                        <div class="flex flex-wrap gap-4 mt-4">--}}
                    {{--                            <button type="button"--}}
                    {{--                                    class="w-10 h-10 bg-black border border-white hover:border-gray-800 rounded-md shrink-0"></button>--}}
                    {{--                            <button type="button"--}}
                    {{--                                    class="w-10 h-10 bg-gray-400 border border-white hover:border-gray-800 rounded-md shrink-0"></button>--}}
                    {{--                            <button type="button"--}}
                    {{--                                    class="w-10 h-10 bg-orange-400 border border-white hover:border-gray-800 rounded-md shrink-0"></button>--}}
                    {{--                            <button type="button"--}}
                    {{--                                    class="w-10 h-10 bg-red-400 border border-white hover:border-gray-800 rounded-md shrink-0"></button>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <hr class="my-8" />--}}

                    <div class="flex flex-row space-x-4">
                        <button type="button" wire:click="order({{ $product['id'] }})"
                                class="w-1/2 px-4 py-3 bg-gradient-to-tr from-emerald-950 to-emerald-700
                                hover:bg-gradient-to-br text-white text-sm
                                font-semibold rounded-md">
                            Buy now
                        </button>
                        <button type="button" class="w-1/2 px-4 py-2.5 border border-emerald-700
                        bg-transparent hover:bg-gradient-to-tr hover:from-emerald-950 hover:to-emerald-700
                        text-emerald-800 hover:text-slate-100 text-sm font-semibold rounded-md"
                                wire:click="addToCart({{ $product['id'] }},1)">
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-20 w-full flex flex-col md:flex-row ">
                <div class="w-full md:w-3/5">
                    <ul class="flex border-b">
                        <li
                            class="font-semibold text-sm py-3 px-8 border-b-2
                            border-gray-800 cursor-pointer transition-all">
                            Description
                        </li>
                        <li class="text-gray-700 font-semibold text-sm hover:bg-gray-100 py-3 px-8 cursor-pointer transition-all">
                            Reviews
                        </li>
                    </ul>
                    <div class="mt-8">
                        <h3 class="text-xl font-bold ">Product Description</h3>
                        <article class="text-sm mt-4 whitespace-pre-line prose dark:prose-invert">
                            {!! Str::markdown($product['description']) !!}
                        </article>
                    </div>
                </div>
                <div class="w-full md:w-2/5 ">
                    <livewire:guest.product.related :productId="$product['id']"
                                                    :categoryId="$product['category']['id']"
                                                    :brandId="$product['brand']['id']"  />
                </div>

            </div>
        </div>
    </div>
</section>

