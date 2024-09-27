<section>
    @can('brand-create')
        <x-slot name="button">
            <a href="{{ route('admin.brand.create') }}" wire:navigate>
                <x-button info label="Add Brand" icon="plus" outline hover="info"
                          class="leading-loose font-bold uppercase text-gray-700 dark:text-gray-200" />
            </a>
        </x-slot>
    @endcan
    <div class="my-6">

        {{ $this->table }}

    </div>
</section>
