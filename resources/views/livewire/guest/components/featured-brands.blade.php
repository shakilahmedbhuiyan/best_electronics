<section class="my-2 mx-5 sm:mx-8" wire:ignore>

    <div class="container relative z-40 mx-auto mt-8 swiper overflow-hidden w-full">
        <h2 class="text-3xl font-bold text-center text-blue-900 font-heading uppercase lg:text-4xl md:text-3xl">
            {!! "featured brands" !!}
        </h2>

        <div class="flex justify-center mx-auto lg:w-full pb-3
        md:w-5/6 xl:shadow-small-blue swiper-wrapper gap-3 sm:gap-2">

            @foreach($brands as $brand=>$b)
                <a href="#" class="swiper-slide" wire:key="swiper-slide-{{$brand}}">
                    <div class="max-w-sm rounded overflow-hidden shadow-lg flex flex-col justify-center items-center">
                        <img class="h-28 w-28 aspect-square" src="{{ asset($b->thumbnail) }}"
                             alt="{{ $b->name }}">
                        <div class="py-4">
                            <div class="text-lg mb-2">{{ $b->name }}</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>


