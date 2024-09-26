<section>
    <x-slot name="header">
        {{ __($header) }}
    </x-slot>
    <x-slot name="button">
        <a href="{{ route('admin.product.index') }}" wire:navigate>
            <x-button-1 type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
            </x-button-1>
        </a>
    </x-slot>


    <div class="flex flex-col items-center justify-center my-4 w-full">

        <form wire:submit.prevent="store" class="w-full space-y-4">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <x-input type="text" icon="device-phone-mobile" wire:model.defer="form.name"
                         placeholder="Product Name" />
                <x-input type="text" icon="link" wire:model.defer="form.slug" placeholder="Product Slug" />
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="space-y-4">
                    <x-input type="text" icon="currency-dollar" wire:model.defer="form.price"
                             placeholder="Product Price" />
                    <x-input type="text" icon="currency-dollar" wire:model.defer="form.sale_price"
                             placeholder="Product Sale Price" />
                    <x-input type="text" wire:model.defer="form.quantity" icon="cube"
                             placeholder="Product Stock Quantity" />
                    <x-select wire:model.defer="form.category" label="Product Category"
                              placeholder="Select Product Category">
                        @forelse($categories as $c)
                            <x-select.user-option :src=" asset($c->thumbnail)"
                                                  label="{{ $c->name }}" value="{{ $c->id }}" />
                        @empty
                            <x-select.user-option label="No Category Available" />
                        @endforelse
                    </x-select>
                    <x-select wire:model.defer="form.brand" label="Product Brand"
                              placeholder="Select Product Brand">
                        @forelse( $brands as $b)
                            <x-select.user-option :src=" asset($b->thumbnail)"
                                                  label="{{ $b->name }}" value="{{ $b->id }}" />
                        @empty
                            <x-select.user-option label="No Brand Available" />
                        @endforelse
                    </x-select>


                </div>

                <!-- product image upload -->
                <div class="flex items-center justify-center ">
                    <div class="" x-data="previewImage()" wire:loading.class="d-block opacity-20 blur-sm">
                        <x-input-error for="form.thumbnail" />
                        <div class="w-60 h-60 rounded bg-gray-100 border border-blue-200 flex
                                    items-center justify-center overflow-hidden">
                            <img x-show="imageUrl" :src="imageUrl" class="w-full object-cover">
                            <div x-show="!imageUrl" class="text-gray-300 flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <div>Image Preview</div>
                            </div>
                        </div>
                        <div>
                            <label for="logo" class="block mb-2 mt-4 ">Product Image</label>
                            <input class="w-full cursor-pointer" type="file" name="logo" id="logo"
                                   wire:model.defer="form.thumbnail" @change="fileChosen" />
                        </div>
                    </div>

                </div>


            </div>


            <div class="flex justify-center items-center ">
                <x-button-1 type="submit" class="w-80">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="h-5 w-5 mr-2">
                        <path d="M10.5 18.75a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" />
                        <path fill-rule="evenodd"
                              d="M8.625.75A3.375 3.375 0 0 0 5.25 4.125v15.75a3.375 3.375 0 0 0 3.375 3.375h6.75a3.375 3.375 0 0 0 3.375-3.375V4.125A3.375 3.375 0 0 0 15.375.75h-6.75ZM7.5 4.125C7.5 3.504 8.004 3 8.625 3H9.75v.375c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125V3h1.125c.621 0 1.125.504 1.125 1.125v15.75c0 .621-.504 1.125-1.125 1.125h-6.75A1.125 1.125 0 0 1 7.5 19.875V4.125Z"
                              clip-rule="evenodd" />
                    </svg>
                    {!! "Add Device" !!}
                </x-button-1>
            </div>

        </form>

    </div>


</section>
@push('scripts')
    <script>
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
