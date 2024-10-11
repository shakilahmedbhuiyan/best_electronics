@props([
    'route'=>'index',
    'title'=>'title',
    'id'=>'',
    'type'=>'page',
    ])

<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-primary-200 hover:text-primary-800 rounded
@if( Route::currentRouteName()=== $route )text-primary-700 @endif " wire:navigate
   @if( $type === 'page')
       href="{{ route($route)  }}"
   @elseif( $type === 'category')
       href="{{ route('index.category', $route)}}"
   @elseif( $type === 'brand')
       href="{{ route('index.brand', $route)}}"
   @elseif( $type === 'external')
       href="{{ $route }}"
   @else
       href="{{ $route }}"
        @endif
>

    {{ $title }}
</a>

