<section>
    <x-slot name="header">
        {{ __($header) }}
    </x-slot>
    <x-slot name="button">
        <div class="flex flex-row justify-center items-center space-x-2 w-full">
            <div class="w-80" id="productHeader"></div>
            @can('product-create')
                <a href="{{ route('admin.product.create') }}" wire:navigate>
                    <x-button-1 type="button" class="drop-shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                             fill="currentColor" class="w-5 h-5 mr-2">
                            <path d="M10.5 18.75a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" />
                            <path fill-rule="evenodd"
                                  d="M8.625.75A3.375 3.375 0 0 0 5.25 4.125v15.75a3.375 3.375 0 0 0 3.375 3.375h6.75a3.375 3.375 0 0 0 3.375-3.375V4.125A3.375 3.375 0 0 0 15.375.75h-6.75ZM7.5 4.125C7.5 3.504 8.004 3 8.625 3H9.75v.375c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125V3h1.125c.621 0 1.125.504 1.125 1.125v15.75c0 .621-.504 1.125-1.125 1.125h-6.75A1.125 1.125 0 0 1 7.5 19.875V4.125Z"
                                  clip-rule="evenodd" />
                        </svg>

                        {!! 'New Product' !!}
                    </x-button-1>
                </a>
            @endcan
        </div>
    </x-slot>

    <!-- Teleport the search input to the #userHeader div -->
    <template x-teleport="#productHeader">
        <x-input placeholder="Search Products" info wire:model.live="search">
            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                    <x-button
                        wire:click="SearchProducts"
                        class="h-full rounded-r-md"
                        icon="magnifying-glass"
                        info flat squared />
                </div>
            </x-slot>
        </x-input>
    </template>

    @if($cache)
        <span class="text-xs text-gray-500 dark:text-gray-400">Cache: </span>
    @else
        <span class="text-xs text-gray-500 dark:text-gray-400">No Cache: </span>
    @endif

    <!-- Display product cards in a grid -->
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-10 my-4">
        @foreach( $products as $p)
            <!-- product Card -->
            <div class="rounded overflow-hidden shadow-lg flex flex-col" wire:loading.remove>
                <!-- Product Image -->
                <div class="relative">
                    <img class="w-66 object-cover aspect-square"
                         src="{{ asset($p->thumbnail) ?? 'https://via.placeholder.com/150' }}"
                         alt="{{$p->name}}">
                    <!-- User Settings Button -->
                    <div class=" text-xs absolute top-0 right-0 px-4 py-2 text-white mt-3 mr-3">
                        <a href="{{ route('admin.product.update', $p->id) }}" wire:navigate>
                            <x-mini-button rounded primary icon="pencil"
                                           wire:loading.class="h-5 w-5 animate-spin" />
                        </a>
                    </div>
                </div>

                <!-- product Details -->
                <div class="px-6 py-4 mb-auto bg-white dark:bg-slate-800">
                    <h3 class="font-medium capitalize text-gray-800 dark:text-gray-100 mb-2">
                        {{ $p['name'] }}
                    </h3>
                    <ul class="text-gray-500 text-sm">
                        <li>Category: {{ $p->category->name }}</li>
                        <li>Brand: {{ $p->brand->name }}</li>
                        <li>Stock: {{ $p->quantity." units" }}</li>
                    </ul>
                </div>

                <!-- Price -->
                <div class="px-6 py-3 flex flex-row items-center justify-around bg-gray-100 dark:bg-slate-700
                text-gray-800 dark:text-gray-100">
                    <span>{!! "Price:" !!}</span>
                    <span class=" @if($p->sale) line-through @endif">
                        {{ $p->price }}
                    </span>
                    <span>
                        {{ $p->sale_price??'' }}
                    </span>
                </div>
            </div>

            <!-- loading skeleton -->
            <div class="rounded overflow-hidden shadow-lg flex flex-col animate-pulse" wire:loading>
                <!-- Product Image -->
                <div class="relative">
                    <div class="w-66 h-56 bg-gray-200"></div>
                    <!-- User Settings Button -->
                    <div class="text-xs absolute top-0 right-0 px-4 py-2 text-white mt-3 mr-3">
                        <div class="h-5 w-5 bg-gray-200 rounded"></div>
                    </div>
                </div>

                <!-- User Details -->
                <div class="px-6 py-4 mb-auto bg-white dark:bg-slate-800">
                    <div class="h-4 bg-gray-200 rounded w-1/2 mb-2"></div>

                    <ul class="space-y-2">
                        <li>
                            <div class="h-4 bg-gray-200 rounded w-1/3"></div>
                        </li>
                        <li>
                            <div class="h-4 bg-gray-200 rounded w-1/3"></div>
                        </li>
                        <li>
                            <div class="h-4 bg-gray-200 rounded w-1/3"></div>
                        </li>
                    </ul>
                </div>
            </div>

        @endforeach
        @if(!isset($products) || count($products) <= 0)
            <!-- No product card -->
            <div class="col-span-full flex justify-center items-center">
                <div
                    class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 p-4 rounded-md shadow-md">
                    <h3 class="text-lg font-bold">No Product found</h3>
                    <p>Try adjusting your search or adding new product.</p>
                </div>
            </div>
        @endif


    </div>
    <!-- Pagination -->
    <div class="flex justify-center">
        <x-filament::pagination :paginator="$products"
                                :page-options="[5, 10, 15, 30, 50, 'all']"
                                :current-page-option-property="$perPage"
                                wire:model.live="perPage"
                                extreme-links />
    </div>


</section>

