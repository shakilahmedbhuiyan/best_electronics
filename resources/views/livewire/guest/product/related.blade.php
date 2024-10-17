<div>

    @isset( $products)
        <div class="container">
            <h3 class="text-center font-serif text-lg text-primary-700 dar:text-primary-500">
                {{ __('Related Products') }}
            </h3>
            <div class="grid grid-cols-1 gap-3 mt-3">
                @foreach( $products as $product)
                    <div class="grid grid-cols-3 gap-2 bg-white dark:bg-gray-900 drop-shadow-lg rounded-lg">
                        <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}"
                             class="h-28 w-28 object-contain aspect-square">
                        <div class="col-span-2 py-4">
                            <a href="{{ route('product.single', $product->slug) }}" aria-label="{{ $product->name }}"
                               wire:navigate>
                                <h4 class="font-serif">{{ $product->name }}</h4>
                            </a>
                            <div class="inline-flex items-center">
                                <a href="{{ route('index.brand', $product->brand->slug) }}"
                                   aria-label="{{ $product->brand->name }}" wire:navigate>
                                      <span
                                          class="text-secondary-700 dark:text-secondary-400 mr-3 uppercase text-sm font-medium">
                                        {{ $product->brand->name }}
                                      </span>
                                </a>
                                <a href="{{ route('index.category', $product->category->slug) }}"
                                   aria-label="{{ $product->category->name }}" wire:navigate>
                                      <span
                                          class="text-secondary-700 dark:text-secondary-400 mr-3 uppercase text-sm font-medium">
                                        {{ $product->category->name }}
                                      </span>
                                </a>
                            </div>
                            <div class="flex flex-row items-center align-bottom dark:text-secondary-300 ">
                                <p class="font-medium cursor-auto my-3">
                                    {!! "SAR ". (isset($product->sale_price) ? $product->sale_price : $product->price) !!}
                                </p>
                                @if($product->sale_price && $product->sale === 1)
                                    <del>
                                        <p class="text-sm cursor-auto ml-2">
                                            {!! $product->price !!}
                                        </p>
                                    </del>
                                @endif

                                <a href="{{ route('product.single', $product->slug) }}"
                                     aria-label="{{ $product->name }}"
                                     wire:navigate class="ltr:ml-auto rtl:mr-auto">
                                    <x-button type="button" flat
                                              aria-label="{{ $product->name.' add to cart button' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                            <path
                                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                        </svg>
                                    </x-button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endisset

</div>
