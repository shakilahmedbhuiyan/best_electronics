<section>
    <x-slot name="header">
        {{ __($header) }}
    </x-slot>
    <x-slot name="button">
        @can('role-create')
            <a href="{{ route('admin.roles.create') }}" wire:navigate>
                <x-button-1 type="button" class="drop-shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                    </svg>

                    {!! 'Create Role' !!}
                </x-button-1>
            </a>
        @endcan
    </x-slot>

    <!-- Roles Table -->
    <div class="relative overflow-x-auto sm:rounded-lg my-5" wire:loading.class="opacity-50">
        <x-table-hover>
            <x-slot name="thead">
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($roles as $key => $role)
                    <tr>
                        <td class="px-6 py-4">{{ $role->id }}</td>
                        <td class="px-6 py-4">{{ $role->name }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a class="btn btn-info" href="">
                                <x-btn-view wire:loading.attr="disabled">
                                    {{ __('View') }}
                                </x-btn-view>
                            </a>
                            @can('role-edit')
                                <a class="btn btn-primary" href="{{ route('admin.roles.update', $role->id) }}"
                                    wire:navigate>
                                    <x-btn-edit wire:loading.attr="disabled">
                                        {{ __('Edit') }}
                                    </x-btn-edit>
                                </a>
                            @endcan
                            @can('role-delete')
                                <x-btn-delete type="button" wire:click="delete({{ $role->id }})"
                                    wire:confirm="Are you sure you want to delete this post?" wire:loading.attr="disabled">
                                    {{ __('Delete') }}
                                </x-btn-delete>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table-hover>
    </div>

    <!-- Permissions Table -->
    <div>
        {{ $this->table }}

    </div>

</section>
