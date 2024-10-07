<div class="w-full antialiased  relative overflow-clip ">

    <div class="flex flex-col max-w-4xl mx-auto px-5 py-4 sm:py-12 sm:flex-row items-center justify-center space-x-0 sm:space-x-8 z-50">
        <div class="sm:h-80 h-48 w-48 sm:w-80 aspect-square object-cover hidden sm:block">
            <x-buy-now class="z-60 drop-shadow-lg transition-all delay-1000 duration-1000 ">

            </x-buy-now>
        </div>
        <div class="flex flex-col justify-start items-center h-full ">
            <h2 class="sm:text-2xl font-black font-serif flex flex-wrap sm:flex-col h-full
            justify-center items-center -mt-6 transition-all delay-3 duration-500">
                <span class="text-teal-600 skew-y-0 sm:-skew-y-6">
                    BUY NOW
                </span>
                <span class="text-4xl sm:text-6xl leading-loose -my-3 text-orange-600 skew-y-0 sm:-skew-y-6 ">PAY</span>
                <span class="text-2xl sm:text-4xl text-emerald-800 italic skew-x-0 sm:-skew-y-6 skew-y-0">LATER</span>
            </h2>
            <p class="text-emerald-800 dark:text-emerald-600 text-md text-justify">
                {{ __("Buy now and pay later with our flexible payment options.
We offer a wide range of payment options with upto 36 months of instalment to suit your needs") }}
            </p>

        </div>
    </div>

    <div class="absolute top-3 left-0 rtl:right-0 sm:h-72 h-40 w-64 sm:w-[calc(50%-6rem)] -z-10 shadow-xl
     animate-pulse delay-500 duration-1000 translate-x-6 hidden sm:block
         bg-gradient-to-tl from-transparent to-emerald-200/75 dark:to-slate-700/75
          ltr:rounded-r-full rtl:rounded-l-full rotate-[-50] transform"></div>

    <div class="absolute -bottom-14 sm:bottom-10 ltr:left-4 rtl:right-4 h-24 w-full space-y-2 sm:flex
     flex-col items-end rotate-0 ltr:sm:rotate-6 rtl:sm:-rotate-6 delay-500 duration-1000 hidden  ">
        <div class="h-5 sm:h-12 w-2/6 drop-shadow-lg animate-pulse
         ltr:bg-gradient-to-r rtl:bg-gradient-to-l from-orange-600 via-yellow-600/60 to-transparent rounded-3xl"></div>
        <div class="h-3 sm:h-8 w-3/12 drop-shadow-lg animate-pulse transition-all delay-500
         ltr:bg-gradient-to-r rtl:bg-gradient-to-l from-orange-600 via-yellow-600/60 to-transparent rounded-2xl"></div>
    </div>


</div>
