<section>

    <x-slot name="button">
        <x-button x-on:click="$wire.dispatch('order-created')" class="bg-green-500 hover:bg-green-700">
            Export
        </x-button>
    </x-slot>

    <div class="my-4">
        {{ $this->table }}
    </div>
</section>
