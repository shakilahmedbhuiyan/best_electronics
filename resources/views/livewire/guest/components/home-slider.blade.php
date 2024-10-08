

<div x-data="{
autoplayIntervalTime: 5000,
     slides: @js($sliders->map(function ($slider) {
        return [
            'imgSrc' => asset( $slider->image), // Assuming your image path is stored in 'image'
            'imgAlt' => $slider->title.' slider', // Assuming you have a title for alt text
            'link' => $slider->link?? '#', // Assuming you have a link for the image
        ];
    })),
    currentSlideIndex: 1,
    isPaused: false,
    autoplayInterval: null,
    previous() {
        if (this.currentSlideIndex > 1) {
            this.currentSlideIndex = this.currentSlideIndex - 1
        } else {
            this.currentSlideIndex = this.slides.length
        }
    },
    next() {
        if (this.currentSlideIndex < this.slides.length) {
            this.currentSlideIndex = this.currentSlideIndex + 1
        } else {
            this.currentSlideIndex = 1
        }
    },
    autoplay() {
        this.autoplayInterval = setInterval(() => {
            if (! this.isPaused) {
                this.next()
            }
        }, this.autoplayIntervalTime)
    },
    setAutoplayInterval(newIntervalTime) {
        clearInterval(this.autoplayInterval)
        this.autoplayIntervalTime = newIntervalTime
        this.autoplay()
    },
}" x-init="autoplay"
     class="inline-flex justify-center items-center w-full overflow-hidden ">
    <div class="relative w-full mx-0 sm:mx-8 ">

        <!-- previous button -->
        <button type="button"
                class="absolute left-5 top-1/2 z-20 flex rounded-full
                -translate-y-1/2 items-center justify-center bg-white/40
                p-2 text-neutral-600 transition hover:bg-white/60 focus-visible:outline
                focus-visible:outline-2 focus-visible:outline-offset-2
                focus-visible:outline-black active:outline-offset-0
                dark:text-gray-400 dark:hover:bg-neutral-800/60 dark:focus-visible:outline-white"
                aria-label="previous slide" x-on:click="previous()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                 stroke-width="3"
                 class="size-5 md:size-6 pr-0.5" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </button>

        <!-- next button -->
        <button type="button"
                class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center
                justify-center bg-white/40 p-2 text-neutral-600 transition hover:bg-white/60
                focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                focus-visible:outline-black active:outline-offset-0
                dark:text-gray-400 dark:hover:bg-neutral-800/60 dark:focus-visible:outline-white"
                aria-label="next slide" x-on:click="next()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                 stroke-width="3"
                 class="size-5 md:size-6 pl-0.5" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </button>

        <!-- slides -->
        <!-- Change aspect-[3/1] to match your images aspect ratio -->
        <div class="relative  sm:aspect-[3/1] aspect-[9/4] w-full sm:rounded-lg overflow-hidden">
            <template x-for="(slide, index) in slides">
                <a :href="slide.link" target="_blank" x-bind:aria-label="slide.imgAlt">
                    <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0"
                         x-transition.opacity.duration.700ms>
                        <img class="absolute w-full h-full inset-0 object-fill sm:object-cover text-neutral-600 dark:text-neutral-300"
                             x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />
                    </div>
                </a>
            </template>
        </div>
    </div>
</div>

