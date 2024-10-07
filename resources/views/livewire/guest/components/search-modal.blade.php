<div id="searchModal">
    <x-modal name="searchModal" class="w-full items-center" align="center">
        <x-card class="dark:bg-gray-800 w-full">
            <x-slot name="title">
                <h2 class="text-lg font-semibold">Search</h2>
            </x-slot>
            <form class="flex flex-col space-y-4 w-full">
                <x-input wire:model.defer="input" type="text" class="w-full px-4 py-2 rounded-md"
                         x-on:keydown.enter="$wire.search()"
                         placeholder="Search products...." autofocus>
                    <x-slot name="append">
                        <x-button type="submit"
                                  class="h-full"
                                  icon="magnifying-glass"
                                  rounded="rounded-r"
                                  label="Search"
                                  primary
                                  wire:click.prevent="search()"
                        />
                    </x-slot>
                </x-input>
            </form>

        </x-card>
    </x-modal>
</div>
