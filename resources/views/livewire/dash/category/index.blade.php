<section>
    @can('category-create')
        <x-slot name="button">
            <a href="{{ route('admin.category.create') }}" wire:navigate>
                <x-button info label="Add Category" icon="plus" outline hover="info"
                          class="leading-loose font-bold uppercase text-gray-700 dark:text-gray-200" />
            </a>
        </x-slot>
    @endcan
</section>
