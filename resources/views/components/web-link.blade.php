@props([
    'route'=>'/',
    'title'=>'title',
    'id'=>'',
    'type'=>'page',
    ])

<a class="relative block py-6 px-4 text-sm lg:text-base  hover:bg-emerald-800
@if(Route::currentRouteName()=== $route )text-emerald-700 hover:text-white font-bold @endif " wire:navigate
   @if( $type === 'page')
       href="{{ route($route)  }}"
   @elseif( $type === 'category')
       href="{{ route('index.category', $route)}}"
   @elseif( $type === 'external')
       href="{{ $route }}"
   @else
       href="{{ $route }}"
        @endif
>

    {{ $title }}
</a>

