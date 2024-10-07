<section class="overflow-hidden w-full" id="products_index">
    <div class="w-full sm:w-10/12 px-5 mx-auto my-2 rounded-lg bg-primary-100 dark:bg-transparent">
        <div class="grid grid-cols-1  sm:grid-cols-3 gap-4 ">
            <div class="col-span-2 p-5">
                <h2 class="text-2xl text-primary-800 font-bold">{{ __($this->title) }}</h2>
                <p class="text-md text-secondary-700 dark:text-secondary-400"> {{ __($this->description) }}</p>
            </div>
            <img src="{{ asset('assets/img/pay-later.png') }}" alt="buy now"
                 class="col-span-1 sm:col-span-1 h-28 w-full object-contain aspect-video" />
        </div>
    </div>
    <!-- ✅ Grid Section - Starts Here 👇 -->
    <section id="ProductsCollection">
        <div class="w-full sm:w-fit overflow-hidden mx-auto grid grid-cols-2 lg:grid-cols-4 md:grid-cols-3
             sm:grid-cols-2 justify-items-center
              justify-center gap-y-8 gap-x-3 sm:gap-x-8 py-5 px-4">
            @foreach ($products as $d)
                <x-public.product-card :product="$d" />
            @endforeach
        </div>

        <div class="w-10/12 my-4 mx-auto">
            {{ $products->links() }}
        </div>

    </section>


</section>
