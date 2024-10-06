<div class="bg-slate-200 dark:bg-gray-900 pt-5 pb-8">
    <div class="text-center p-5 flex flex-row justify-between items-center">
        <h1 class="text-3xl font-bold text-emerald-800 dark:text-emerald-600 font-serif leading-loose uppercase">
            Latest Products
        </h1>
        <a href="{{ route('products.all') }}" title="All Products" class="hidden sm:block">
            <x-button type="button" flat> {{ __('Browse All')}}</x-button>
        </a>
    </div>
    <!-- ✅ Grid Section - Starts Here 👇 -->
    <section id="LatestProducts"
             class="w-full sm:w-fit overflow-hidden mx-auto grid grid-cols-2 lg:grid-cols-4 md:grid-cols-3
             sm:grid-cols-2 justify-items-center
              justify-center gap-y-8 gap-x-3 sm:gap-x-8 py-5 px-4">

        @foreach ($latestDevices as $ld)
          <x-public.product-card :product="$ld" />
        @endforeach
    </section>
    <div class="text-right block sm:hidden px-4">
        <a href="{{ route('products.all') }}" title="All Products">
            <x-button type="button" flat> {{ __('Browse All')}}</x-button>
        </a>
    </div>
</div>
