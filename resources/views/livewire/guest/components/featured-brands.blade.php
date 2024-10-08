<section class="my-2 mx-5 sm:mx-8" wire:ignore>

    <div class="container relative z-40 mx-auto mt-8 swiper overflow-hidden w-full">
        <h2 class="text-3xl font-bold text-center text-primary-800 dark:text-primary-500 font-heading uppercase mb-3 lg:text-4xl md:text-3xl">
            {!! __("featured brands") !!}
        </h2>

        <div class="flex flex-row w-full justify-center pb-3
        xl:shadow-small-blue  gap-3 sm:gap-2 overflow-x-auto soft-scrollbar">

            @foreach($brands as $brand=>$b)
                <a href="#" class="w-full" wire:key="swiper-slide-{{$brand}}"
                   role="brandLogo" aira-label="{{$brand . ' logo slider'}}">
                    <div class=" rounded overflow-hidden shadow-lg flex flex-col justify-center items-center">
                        <img class="h-28 w-28 aspect-square" src="{{ asset($b->thumbnail) }}"
                             alt="{{ $b->name. ' logo' }}" aira-label="{{$brand . ' logo'}}">
                        <div class="py-4">
                            <div class="text-lg capitalize text-secondary-700 dark:text-secondary-300 mb-2">{{ $b->name }}</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>

</section>


