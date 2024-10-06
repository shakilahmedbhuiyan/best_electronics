<section class="overflow-hidden w-full" id="products_index">
   <div class="w-full sm:w-10/12 px-5 mx-auto my-2 rounded-lg bg-primary-100 dark:bg-transparent">
       <div class="grid grid-cols-1  sm:grid-cols-3 gap-4 p-5">
           <div class="col-span-2">
               <h2 class="text-2xl text-primary-800 font-bold">{{ __($this->title) }}</h2>
               <p class="text-md text-secondary-700 dark:text-secondary-400"> {{ __($this->description) }}</p>
           </div>
       </div>
   </div>
    <livewire:guest.components.product-collection />

</section>
