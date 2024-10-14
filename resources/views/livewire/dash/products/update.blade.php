<section>
    <x-slot name="header">
        {{ __($header) }}
    </x-slot>
    <x-slot name="button">
        <div class="flex flex-row justify-center items-center space-x-2 w-auto">
            <div class="w-80" id="productStatus"></div>
            <a href="{{ route('admin.product.index') }}" wire:navigate>
                <x-button-1 type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                </x-button-1>
            </a>
        </div>
    </x-slot>

    <template x-teleport="#productStatus">
        <div class="inline-flex space-x-4">
            <div class="flex items-center gap-x-2">
                <input
                    class="form-checkbox transition ease-in-out duration-100 rounded border-secondary-300
                text-primary-600 focus:ring-primary-600 focus:border-primary-400 dark:border-secondary-500
                dark:checked:border-secondary-600 dark:focus:ring-secondary-600 dark:focus:border-secondary-500
                 dark:bg-secondary-600 dark:text-secondary-600 dark:focus:ring-offset-secondary-800 w-4 h-4
                 invalidated:focus:ring-negative-500 invalidated:ring-negative-500 invalidated:border-negative-400
                 invalidated:text-negative-600 invalidated:focus:border-negative-400
                 invalidated:dark:focus:border-negative-600 invalidated:dark:ring-negative-600
                 invalidated:dark:border-negative-600 invalidated:dark:bg-negative-700
                 invalidated:dark:checked:bg-negative-700 invalidated:dark:focus:ring-offset-secondary-800
                 invalidated:dark:checked:border-negative-700"

                    type="checkbox" @checked($form['status']) wire:model="form.status">
                <label
                    class="block text-sm font-medium disabled:opacity-60 text-gray-700 dark:text-gray-400
                invalidated:text-negative-600 dark:invalidated:text-negative-700"
                    for="productStatus">
                    {!! 'Active' !!}
                </label>
            </div>
            <div class="flex items-center gap-x-2">
                <input
                    class="form-checkbox transition ease-in-out duration-100 rounded border-secondary-300
                text-primary-600 focus:ring-primary-600 focus:border-primary-400 dark:border-secondary-500
                dark:checked:border-secondary-600 dark:focus:ring-secondary-600 dark:focus:border-secondary-500
                 dark:bg-secondary-600 dark:text-secondary-600 dark:focus:ring-offset-secondary-800 w-4 h-4
                 invalidated:focus:ring-negative-500 invalidated:ring-negative-500 invalidated:border-negative-400
                 invalidated:text-negative-600 invalidated:focus:border-negative-400
                 invalidated:dark:focus:border-negative-600 invalidated:dark:ring-negative-600
                 invalidated:dark:border-negative-600 invalidated:dark:bg-negative-700
                 invalidated:dark:checked:bg-negative-700 invalidated:dark:focus:ring-offset-secondary-800
                 invalidated:dark:checked:border-negative-700"

                    type="checkbox" @checked($form['is_featured']) wire:model="form.is_featured">
                <label
                    class="block text-sm font-medium disabled:opacity-60 text-gray-700 dark:text-gray-400
                invalidated:text-negative-600 dark:invalidated:text-negative-700"
                    for="productStatus">
                    {!! 'Featured' !!}
                </label>
            </div>

            <div class="flex items-center gap-x-2">
                <input
                    class="form-checkbox transition ease-in-out duration-100 rounded border-secondary-300
                text-primary-600 focus:ring-primary-600 focus:border-primary-400 dark:border-secondary-500
                dark:checked:border-secondary-600 dark:focus:ring-secondary-600 dark:focus:border-secondary-500
                 dark:bg-secondary-600 dark:text-secondary-600 dark:focus:ring-offset-secondary-800 w-4 h-4
                 invalidated:focus:ring-negative-500 invalidated:ring-negative-500 invalidated:border-negative-400
                 invalidated:text-negative-600 invalidated:focus:border-negative-400
                 invalidated:dark:focus:border-negative-600 invalidated:dark:ring-negative-600
                 invalidated:dark:border-negative-600 invalidated:dark:bg-negative-700
                 invalidated:dark:checked:bg-negative-700 invalidated:dark:focus:ring-offset-secondary-800
                 invalidated:dark:checked:border-negative-700"

                    type="checkbox" @checked($form['instalment']) wire:model="form.instalment">
                <label
                    class="block text-sm font-medium disabled:opacity-60 text-gray-700 dark:text-gray-400
                invalidated:text-negative-600 dark:invalidated:text-negative-700"
                    for="productStatus">
                    {!! 'Instalment' !!}
                </label>
            </div>

        </div>

    </template>


    <div class="flex flex-col items-center justify-center my-4 w-full">

        <form wire:submit.prevent class="w-full space-y-4">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <x-input type="text" icon="device-phone-mobile" wire:model.defer="form.name"
                         placeholder="Product Name" />
                <x-input type="text" icon="link" wire:model.defer="form.slug" placeholder="Product Slug" />
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-2">
                        <x-currency prefix="SAR" wire:model.defer="form.price"
                                    placeholder="Product Price"
                                    thousands=","
                                    decimal="." />
                        <x-currency prefix="SAR" wire:model.defer="form.sale_price"
                                    thousands=","
                                    decimal="."
                                    right-icon="receipt-percent" variant="solid"
                                    placeholder="Product Sale Price" />
                    </div>
                    <x-input type="text" wire:model.defer="form.quantity" icon="cube"
                             placeholder="Product Stock Quantity" />
                    <div class="grid grid-cols-2 gap-2">
                        <x-select wire:model.defer="form.category_id"
                                  label="Current Category: {{ $product->category->name }}"
                                  placeholder="Select Product Category">
                            @forelse($categories as $c)
                                <x-select.user-option :src=" asset($c->thumbnail)"
                                                      label="{{ $c->name }}"
                                                      value="{{ $c->id }}" />
                            @empty
                                <x-select.user-option label="No Category Available" />
                            @endforelse
                        </x-select>

                        <x-select wire:model.defer="form.brand_id" label="Current Brand: {{ $product->brand->name }}"
                                  placeholder="Select Product Brand">
                            @forelse( $brands as $b)
                                <x-select.user-option :src=" asset($b->thumbnail)"
                                                      label="{{ $b->name }}"
                                                      value="{{ $b->id }}" />
                            @empty
                                <x-select.user-option label="No Brand Available" />
                            @endforelse
                        </x-select>
                    </div>
                    <x-textarea id="trix-content" class="w-full" label="Summary"
                                placeholder="Product Short Summary"
                                wire:model.defer="form.summary"></x-textarea>
                </div>

                <!-- product image upload -->

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 ">
                    <div class="" x-data="previewImage()" wire:loading.class="d-block opacity-20 blur-sm">
                        <x-input-error for="form.thumbnail" />
                        <div class="w-60 h-60 rounded bg-gray-100 border border-blue-200 flex
                                    items-center justify-center overflow-hidden">
                            <img x-show="imageUrl" :src="imageUrl" class="w-full object-cover">
                            <img x-show="!imageUrl" src="{{ asset($product->thumbnail) }}"
                                 class="w-full object-cover">
                        </div>
                        <div>
                            <label for="logo" class="block mb-2 mt-4 ">Product Image</label>
                            <x-jet-input class="w-full cursor-pointer" type="file" name="logo" id="logo"
                                         wire:model.defer="form.thumbnail" @change="fileChosen" />
                        </div>
                    </div>
                    <section class="container">
                        <div class=" main-carousel "
                             data-flickity='{ "wrapAround": true, "autoPlay": 2000, "pageDots": false }'>
                            @forelse( $product->images as $key=>$i)
                                <div class="w-1/3 sm:w-1/2 rounded overflow-hidden shadow-lg flex flex-col
                                 justify-center items-center">
                                    <div class="py-4 relative">

                                        <img class="h-28 w-28 aspect-square" src="{{ asset($i->image) }}"
                                             alt="{{ "gallery" }}">
                                        <x-badge warning icon="trash" rounded="lg" icon-size="md"
                                                 class="absolute top-0 right-0 cursor-pointer "
                                                 wire:click="deleteImage({{ $i->id }})"
                                                 wire:confirm="Are you sure you want to delete this image?" />
                                    </div>
                                </div>
                            @empty
                                <div class="w-full h-60 flex items-center justify-center">
                                    <p class="text-secondary-700 dark:text-secondary-300">No Image Available</p>
                                </div>
                            @endforelse
                        </div>
                        <x-button outline label="Add Product Images" x-on:click="$openModal('productGallery')" primary />
                    </section>
                </div>
            </div>

            <x-textarea id="trix-content" class="w-full" label="Description" rows="10"
                        placeholder="Product Complete Description"
                        wire:model.defer="form.description"></x-textarea>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <x-input type="text" icon="tag" wire:model.defer="form.meta_title"
                         placeholder="Product Meta Title" label="SEO Title" />
                <x-input type="text" icon="tag" wire:model.defer="form.meta_keywords"
                         placeholder="Product Meta Keywords. use comma(,) to separate values" label="SEO Keywords" />
                <x-textarea type="text" icon="tag" wire:model.defer="form.meta_description"
                            class="col-span-full" label="SEO Description" corner="170 character max"
                            placeholder="Product Meta Description. Write in between 60-120 character"></x-textarea>
            </div>


            <div class="flex justify-center items-center ">
                <x-button-1 type="submit" class="w-80" wire:click="store()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="h-5 w-5 mr-2">
                        <path d="M10.5 18.75a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" />
                        <path fill-rule="evenodd"
                              d="M8.625.75A3.375 3.375 0 0 0 5.25 4.125v15.75a3.375 3.375 0 0 0 3.375 3.375h6.75a3.375 3.375 0 0 0 3.375-3.375V4.125A3.375 3.375 0 0 0 15.375.75h-6.75ZM7.5 4.125C7.5 3.504 8.004 3 8.625 3H9.75v.375c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125V3h1.125c.621 0 1.125.504 1.125 1.125v15.75c0 .621-.504 1.125-1.125 1.125h-6.75A1.125 1.125 0 0 1 7.5 19.875V4.125Z"
                              clip-rule="evenodd" />
                    </svg>
                    {!! "Update" !!}
                </x-button-1>
            </div>

        </form>

    </div>


</section>

@push('modals')
    <livewire:dash.components.product-image-upload-modal :product="$product" />
@endpush



@push('scripts')
    <script>
        // const easyMDE = new EasyMDE({ element: document.getElementById('trix-content') })
        // easyMDE.codemirror.on('outside', () => {
        //     @this.set('form.description', easyMDE.value())
        // })
        Livewire.on('productImage', () => {
            this.location.reload()
        })
        function previewImage() {
            return {
                imageUrl: '',
                fileChosen(event) {
                    this.fileToDataUrl(event, (src) => (this.imageUrl = src))
                },

                fileToDataUrl(event, callback) {
                    if (!event.target.files.length) return
                    let file = event.target.files[0],
                        reader = new FileReader()
                    reader.readAsDataURL(file)
                    reader.onload = (e) => callback(e.target.result)
                },
            }
        }
    </script>
@endpush
