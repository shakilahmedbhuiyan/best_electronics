<section>

    <div class="flex flex-col space-y-6 w-full my-6">

        <div class="bg-gray-200 dark:bg-gray-800 rounded p-5 ">
            <h1 class="text-xl font-bold text-gray-500 ">Store Info</h1>
            <form wire:submit.prevent="updateStore" class="flex flex-col sm:flex-row">
                <div class="space-y-4 w-full sm:w-1/2">
                    <x-input wire:model="store.name" label="Store Name" icon="building-storefront" />
                    <x-input wire:model="store.description" label="Store Short Tagline" icon="document-text" />
                    <x-input wire:model="store.phone" label="Store Contact" icon="phone" />
                    <x-input wire:model="store.email" label="Store Email" icon="at-symbol" />
                    <x-input wire:model="store.address" label="Store Address" icon="map-pin" />
                    <x-input wire:model="store.website" label="Website" icon="globe-alt" />
                    <x-input wire:model="store.map_link" label="Map Link" icon="map" />
                    <x-button-1 class="w-full" type="submit" >
                        Update Store Info
                    </x-button-1>
                </div>
            </form>
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
