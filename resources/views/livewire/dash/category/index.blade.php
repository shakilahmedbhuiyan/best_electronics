<section>
    @can('category-create')
        <x-slot name="button">
            <a href="{{ route('admin.category.create') }}" wire:navigate>
                <x-button info label="Add Category" icon="plus" outline hover="info"
                          class="leading-loose font-bold uppercase text-gray-700 dark:text-gray-200" />
            </a>
        </x-slot>
    @endcan

    <div class="my-6">
        <x-card>
            <div
                class="flex flex-row sm:flex-row justify-center items-center w-full space-x-2">
                <div class="w-4/6">
                    <x-input wire:model.live.debounce.1500ms="search" id="search" placeholder="Search Brand" />
                </div>
                <div class="">
                    <x-select wire:model.live="perPage" id="perPage"
                              placeholder="Per Page"
                              :options="[5,10, 20, 50, 100]" />
                </div>
            </div>
            <div class="overflow-x-auto soft-scrollbar py-3">
                <x-table-hover class="w-full py-3">
                    <x-slot name="thead">
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Action</th>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse($categories as $c)
                            <tr>
                                <td class="inline-flex justify-center items-center space-x-4 py-2 col-auto grow-0">
                                    <img src="{{ $c->thumbnail_url }}" alt="{{ $c->name }}"
                                         class="w-12 h-12 aspect-square object-contain rounded-lg">
                                    <span> {{ $c->name }}</span>
                                </td>
                                <td class="py-2">
                                    @if($c->status)
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full bg-emerald-500 text-white">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full bg-red-500 text-white">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="py-2 inline-flex justify-center items-center space-x-2">
                                    <a href="{{ route('admin.category.update', $c->id )}}" wire:navigate>
                                        <x-button warning label="Edit" light hover="emerald"
                                                  class="leading-loose uppercase text-gray-700 dark:text-gray-200" />
                                    </a>
                                    @if( $c->status)
                                        <x-button info label="{{ $c->featured? 'Featured': 'Not Featured'  }}" light
                                                  hover="emerald"
                                                  wire:click="featured({{ $c->id }})"
                                                  class="leading-loose uppercase text-gray-700 dark:text-gray-200" />
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Category Found</td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table-hover>

                {{ $categories->links() }}

            </div>
        </x-card>


    </div>

</section>
