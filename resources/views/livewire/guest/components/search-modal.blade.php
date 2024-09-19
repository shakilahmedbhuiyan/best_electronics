<div id="searchModal">
    <x-modal name="searchModal" class="w-full items-center" align="center">
        <x-card class="dark:bg-white w-full">
            <x-slot name="title">
                <h2 class="text-lg font-semibold">Search</h2>
            </x-slot>
            <div class="flex flex-col space-y-4 w-full">
                <input wire:model="search" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md"
                       placeholder="Search products...." autofocus>
                <div class="flex flex-col space-y-2">
                    @isset($results)
                        @if($results->isEmpty())
                            <p class="text-gray-500">No results found.</p>
                        @endif
                        @foreach($results as $result)
                            <a href="#" class="flex items-center space-x-2">
                                <img src="{{ $result->thumbnail }}" alt="{{ $result->title }}"
                                     class="w-12 h-12 object-cover rounded-md">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $result->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $result->author->name }}</p>
                                </div>
                            </a>
                        @endforeach
                    @endisset
                </div>
            </div>

        </x-card>
    </x-modal>
</div>
