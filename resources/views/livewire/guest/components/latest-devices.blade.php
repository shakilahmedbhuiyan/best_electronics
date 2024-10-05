<div class="bg-slate-200 dark:bg-gray-900 pt-5 pb-8">
    <div class="text-center p-5">
        <h1 class="text-3xl font-bold text-emerald-800 dark:text-emerald-600 font-serif leading-loose uppercase">
            Latest Products
        </h1>
    </div>
    <!-- ✅ Grid Section - Starts Here 👇 -->
    <section id="LatestProducts"
             class="w-full sm:w-fit overflow-hidden mx-auto grid grid-cols-2 lg:grid-cols-4 md:grid-cols-3
             sm:grid-cols-2 justify-items-center
              justify-center gap-y-8 gap-x-3 sm:gap-x-8 py-5 px-4">

        @foreach ($latestDevices as $ld)
            <!--   ✅ Product card 1 - Starts Here 👇 -->
            <div class="w-full relative sm:w-60 bg-white shadow-md rounded-xl
            duration-500 hover:scale-105 hover:shadow-xl overflow-clip">
                <a href="{{ route('product.single', $ld->slug) }}" class="relative" wire:navigate>
                    @isset($ld->sale_price)
                        <div class="bg-orange-500 h-10 w-[10rem] inline-flex justify-center items-center
                absolute top-[5%] left-[50%] rotate-45">
                    <span class="text-white">
                        {{__( 'Sale')}}
                    </span>
                        </div>
                    @endisset
                    <img
                        src="{{ asset($ld->thumbnail) }}"
                        alt="{{ $ld->name }}" class="h-44 w-36 aspect-auto mx-auto object-contain " />
                    <div class="px-4 py-3 w-full">
                        <span class="text-gray-600 mr-3 uppercase text-xs">
                            {{ $ld->brand->name }}
                        </span>
                        <p class="text-md font-semibold text-emerald-800 block capitalize">
                            {{ $ld->name }}
                        </p>
                        <div class="flex items-center">
                            <p class="font-medium text-gray-700 cursor-auto my-3">
                                {!! "SAR ". (isset($ld->sale_price) ? $ld->sale_price : $ld->price) !!}
                            </p>
                            @if($ld->sale_price && $ld->sale === 1)
                                <del>
                                    <p class="text-sm text-gray-600 cursor-auto ml-2">
                                        {!! $ld->price !!}
                                    </p>
                                </del>
                            @endif
                            <div class="ml-auto">
                                <x-button type="button" flat>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                        <path
                                            d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                    </svg>
                                </x-button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!--   ✅ Product card 1 - Ends Here 👆 -->
        @endforeach
    </section>
</div>
