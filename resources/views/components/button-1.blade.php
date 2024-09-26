<button {{ $attributes->merge(
    ['type' => 'submit',
    'class' => 'flex flex-row items-center justify-center px-4 py-2 bg-blue-200/50 dark:bg-gray-700 border border-transparent
    rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-blue-200
    dark:hover:bg-gradient-to-br from-gray-800 via-slate-700 to-slate-800
    disabled:opacity-50 transition ease-in-out duration-150']) }}
    wire:loading.attr="disabled"
>
    {{ $slot }}
</button>
