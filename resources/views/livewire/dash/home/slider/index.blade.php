<section>
    <x-slot name="header">
        {{ __($header) }}
    </x-slot>
    <x-slot name="button">
        @can('slider-create')
            <a href="{{ route('admin.slider.create') }}" wire:navigate>
                <x-button-1 type="button" class="drop-shadow">
                                       {!! 'Add New' !!}
                </x-button-1>
            </a>
        @endcan
    </x-slot>

    <div class="my-6">
        {{ $this->table }}
    </div>
</section>
