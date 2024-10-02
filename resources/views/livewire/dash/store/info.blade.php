<section>
    <div class="flex flex-col space-y-6 w-full my-6">

        <div class="bg-gray-200 dark:bg-gray-800 rounded p-5 ">
            <h1 class="text-xl font-bold text-gray-500 ">Store Info</h1>
            <div class="grid grid-col-1 md:grid-cols-2 gap-4">
                <form wire:submit.prevent="updateStore" class="space-y-4">
                    <x-input wire:model="store.name" label="Store Name" icon="building-storefront" />
                    <x-input wire:model="store.description" label="Store Short Tagline" icon="document-text" />
                    <x-input wire:model="store.phone" label="Store Contact" icon="device-phone-mobile" />
                    <x-input wire:model="store.email" label="Store Email" icon="at-symbol" />
                    <x-input wire:model="store.whatsapp" label="Whatsapp" icon="phone" />
                    <x-input wire:model="store.address" label="Store Address" icon="map-pin" />
                    <x-input wire:model="store.website" label="Website" icon="globe-alt" />
                    <x-input wire:model="store.map_link" label="Map Link" icon="map" />
                    <x-button-1 class="w-full" type="submit">
                        Update Store Info
                    </x-button-1>
                </form>

                <form wire:submit.prevent="updateLogo">
                    <div x-data="previewImage()" wire:loading.target="logo"
                         wire:loading.class="d-block opacity-20 blur-sm">
                        <x-input-error for="logo" />



                        <div class="w-full h-66 rounded bg-gray-100 border border-gray-200 flex
                                    items-center justify-center overflow-hidden">

                            <img x-show="imageUrl" :src="imageUrl" class="w-full aspect-video object-contain">
                            @isset( $logo)
                                <img x-show="!imageUrl" src="{{ asset($logo) }}"
                                     class="w-full aspect-video object-contain">
                            @else
                            <div x-show="!imageUrl" class="text-gray-300 flex flex-col items-center justify-center
                                    w-full aspect-video object-cover">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <div>Image Preview</div>
                            </div>
                            @endisset

                        </div>


                        <div>
                            <label for="logo" class="block mb-2 mt-4 font-bold">Upload image..</label>
                            <x-jet-input class="w-full cursor-pointer" type="file" name="logo" id="logo"
                                         wire:model="logo" @change="fileChosen" />
                        </div>
                           <x-button-1 class="w-full" type="submit">
                            Update Store Logo
                        </x-button-1>
                    </div>
                </form>

            </div>
        </div>
        <div class="bg-gray-200 dark:bg-gray-800 rounded p-5 ">
            <!-- SEO Data -->
            <div class="flex flex-row space-x-4">
                <div class="w-1/2">
                    <label for="store_name" class="block text-sm font-medium text-gray-700">Nombre de la tienda</label>
                    <input type="text" wire:model="store_name" id="store_name"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="w-1/2">
                    <label for="store_slug" class="block text-sm font-medium text-gray-700">Slug de la tienda</label>
                    <input type="text" wire:model="store_slug" id="store_slug"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm
                           border-gray-300 rounded-md">
                </div>
            </div>
        </div>
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
