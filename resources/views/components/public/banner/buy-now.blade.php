<div class="w-full antialiased  relative overflow-clip ">

    <div class="flex flex-col max-w-4xl mx-auto px-5 py-12 sm:flex-row items-center justify-center space-x-0 sm:space-x-8 z-50">
        <div class="h-80 w-80 aspect-video object-cover ">
            <x-buy-now class="z-60 drop-shadow-lg"></x-buy-now>
        </div>
        <div class="flex flex-col justify-start items-center h-full ">
            <h2 class="text-2xl font-black font-serif flex flex-col h-full justify-center items-center -mt-6">
                <span class="text-teal-600">
                    BUY NOW
                </span>
                <span class="text-6xl leading-loose -my-8 text-orange-600">PAY</span>
                <span class="text-4xl text-emerald-800 italic">LATER</span>
            </h2>
            <p class="text-emerald-800 dark:text-emerald-600 text-md text-justify">
                {{ __('Buy now and pay later with our flexible payment options.
We offer a wide range of payment options with upto 36 month instalment to suit your needs') }}
            </p>

        </div>
    </div>

    <div class="absolute top-3 left-0 h-72 w-[calc(50%-4rem)] -z-10 shadow-xl animate-pulse
         bg-gradient-to-tl from-transparent to-emerald-200/75 dark:to-slate-700/75
          rounded-r-full rotate-[-50] transform"></div>

    <div class="absolute bottom-32 sm:bottom-10 left-4  h-24 w-full space-y-2 flex flex-col items-end rotate-0 sm:rotate-6">
        <div class="h-12 w-2/6 drop-shadow-lg animate-pulse
         bg-gradient-to-r from-orange-600 via-yellow-600/60 to-transparent rounded-3xl"></div>
        <div class="h-8 w-3/12 drop-shadow-lg animate-pulse
         bg-gradient-to-r from-orange-600 via-yellow-600/60 to-transparent rounded-2xl"></div>
    </div>


</div>
