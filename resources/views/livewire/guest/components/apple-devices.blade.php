<section id="appleDevices">
    @isset($brand)
        <div class="bg-slate-200 dark:bg-primary-950/30 bg-blend-multiply pt-5 pb-8">
            <div class="text-center p-5 flex flex-row justify-between items-center">
                <h2 class="text-3xl font-bold text-emerald-800 dark:text-emerald-600 font-serif leading-loose uppercase">
                    {{ __($brand->name. ' Products') }}
                </h2>
                <a href="{{ route('index.brand', $brand->slug) }}" title="All Products" class="hidden sm:block">
                    <x-button type="button" outline right-icon="arrow-right">
                        {{ __(' All Products')}}
                    </x-button>
                </a>
            </div>
            <!-- ✅ Grid Section - Starts Here 👇 -->
            <section id="LatestProducts"
                     class="w-full sm:w-fit overflow-hidden mx-auto grid grid-cols-2 lg:grid-cols-4 md:grid-cols-3
             sm:grid-cols-2 justify-items-center
              justify-center gap-y-8 gap-x-3 sm:gap-x-8 py-5 px-4">

                @foreach ($devices as $ap)
                    <x-public.product-card :product="$ap" />
                @endforeach
            </section>
            <a href="{{ route('index.brand', $brand->slug) }}" title="All Products"
               class="text-right block sm:hidden px-4">
                <x-button type="button" outline right-icon="arrow-right">
                    {{ __(' All Products')}}
                </x-button>
            </a>

        </div>
    @endisset
</section>
