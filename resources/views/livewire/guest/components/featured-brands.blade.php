<section class="my-2 mx-5 sm:mx-8" wire:ignore>

    <div class="container mx-auto mt-8 overflow-x-clip">
        <h2 class="text-3xl font-bold text-center text-primary-800 dark:text-primary-500 font-heading uppercase mb-3 lg:text-4xl md:text-3xl">
            {!! __("featured brands") !!}
        </h2>

        <section class="container">
            <div class=" main-carousel "
                 data-flickity='{ "contain": true, "autoPlay": 3000, "pageDots": false }'>
                @foreach($brands as $brand=>$b)

                    <div class="w-4/12 rounded overflow-hidden shadow-lg flex flex-col justify-center items-center">
                        <a href="{{ route('index.brand', $b->slug) }}" class="" id="swiper-slide-{{$brand}}"
                           role="brandLogo" aria-label="{{$brand . ' logo slider'}}">
                            <img class="h-28 w-28 aspect-square" src="{{ $b->thumbnail_url }}"
                                 alt="{{ $b->name. ' logo' }}" aira-label="{{$brand . ' logo'}}">
                        </a>
                    </div>

                @endforeach
            </div>
        </section>

    </div>
</section>



