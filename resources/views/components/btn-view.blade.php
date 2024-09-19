<button {{ $attributes->merge(
    ['type' => 'submit',
    'class' => 'inline-flex items-center px-4 py-1 bg-transparent border-2 border-green-600 dark:border-green-400
    rounded-md font-semibold text-xs text-green-600 dark:text-green-400 hover:text-white dark:hover:text-slate-700
    uppercase tracking-widest hover:bg-green-600 dark:hover:bg-green-400 flex flex-row space-x-2
    disabled:opacity-50 transition ease-in-out duration-150']) }}>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
        <path
            d="M6 3a3 3 0 0 0-3 3v1.5a.75.75 0 0 0 1.5 0V6A1.5 1.5 0 0 1 6 4.5h1.5a.75.75 0 0 0 0-1.5H6ZM16.5 3a.75.75 0 0 0 0 1.5H18A1.5 1.5 0 0 1 19.5 6v1.5a.75.75 0 0 0 1.5 0V6a3 3 0 0 0-3-3h-1.5ZM12 8.25a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5ZM4.5 16.5a.75.75 0 0 0-1.5 0V18a3 3 0 0 0 3 3h1.5a.75.75 0 0 0 0-1.5H6A1.5 1.5 0 0 1 4.5 18v-1.5ZM21 16.5a.75.75 0 0 0-1.5 0V18a1.5 1.5 0 0 1-1.5 1.5h-1.5a.75.75 0 0 0 0 1.5H18a3 3 0 0 0 3-3v-1.5Z"/>
    </svg>
    <span>
         {{ $slot }}
    </span>
</button>
