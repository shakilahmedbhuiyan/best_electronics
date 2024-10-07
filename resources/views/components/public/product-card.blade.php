@props(['product'])


<!--   ✅ Product card 1 - Starts Here 👇 -->
<div wire:loading.remove class="w-full sm:w-60 bg-white dark:bg-gray-900 shadow-md rounded-xl
            duration-500 hover:scale-105 hover:shadow-xl overflow-clip">
    <a href="{{ route('product.single', $product->slug) }}" class="relative" wire:navigate>
        @isset($product->sale_price)
            <div class="bg-orange-400/85 h-10  w-44 sm:w-[10rem] inline-flex justify-center items-center
                        absolute top-[1.5rem] sm:top-[1rem] left-24 sm:left-[8rem] rotate-45 z-20">
                            <span class="text-white font-semibold leading-loose">
                                {{__( 'Sale')}}
                            </span>
            </div>
        @endisset
      <div class="w-full bg-primary-50 dark:bg-gray-600 overflow-hidden">
            <img
            src="{{ asset($product->thumbnail) }}"
            alt="{{ $product->name }}" class="h-44 w-36 aspect-auto mx-auto object-contain
             transform delay-100 duration-300 hover:scale-125 " />
      </div>
        <div class="px-4 py-3 w-full ">
            <span class="text-secondary-700 dark:text-secondary-400 mr-3 uppercase text-sm font-medium">
                {{ $product->brand->name }}
            </span>
            <p class="text-md font-semibold text-primary-800 dark:text-primary-600 block capitalize">
                {{ $product->name }}
            </p>
        </div>
        <div class="px-4 py-3 flex items-center align-bottom dark:text-secondary-300 ">
            <p class="font-medium cursor-auto my-3">
                {!! "SAR ". (isset($product->sale_price) ? $product->sale_price : $product->price) !!}
            </p>
            @if($product->sale_price && $product->sale === 1)
                <del>
                    <p class="text-sm cursor-auto ml-2">
                        {!! $product->price !!}
                    </p>
                </del>
            @endif
            <div class="ltr:ml-auto rtl:mr-auto">
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
    </a>
</div>
<!--   ✅ Product card 1 - Ends Here 👆 -->

<div wire:loading
    class="w-full sm:w-60 bg-gray-200 animate-pulse dark:bg-gray-900 shadow-md rounded-xl overflow-clip">
    <div class="relative">
        <div class="h-44 w-36 aspect-auto mx-auto" ></div>
        <div class="px-4 py-3 w-full">
            <div class="h-4 bg-gray-400 rounded w-1/4"></div>
            <div class="h-4 bg-gray-400 rounded w-1/2 my-2"></div>
        </div>
        <div class="px-4 py-3 flex items-center align-bottom">
            <div class="font-medium h-4 cursor-auto my-3 bg-gray-400 rounded w-1/4"></div>
            <div class="ltr:ml-auto rtl:mr-auto">
                <div class="h-10 w-10 bg-gray-400 rounded"></div>
            </div>
        </div>
    </div>
</div>
