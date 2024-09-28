<div id="logo-sidebar" x-show="sidebar" :class="{ 'fixed': sidebar, 'absolute': !sidebar }"
     class="sm:w-60 w-1/2 h-full top-0 left-0 pt-20 bg-white border-r border-gray-200 dark:bg-slate-800
     dark:border-gray-700 overflow-y-auto transition-all duration-300 ease-in-out">
    <div class="h-full px-3 pb-4 bg-white dark:bg-slate-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('admin.dashboard') }}" wire:navigate
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-slate-300 dark:hover:bg-gray-700 group">
                    <svg
                        class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            @can('product-list')
                <li class="inline-flex w-full items-center justify-end bg-blue-200 dark:bg-slate-900 px-4
                text-gray-900 rounded-lg dark:text-slate-300">
                    <span>Products</span>
                </li>
            @endcan

            @can('category-list')
                <li>
                    <a href="{{ route('admin.category.index') }}" wire:navigate
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-slate-300 dark:hover:bg-gray-700 group">
                        <svg
                            class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Category</span>

                    </a>
                </li>
            @endcan
            @can('brand-list')
                <li>
                    <a href="{{ route('admin.brand.index') }}" wire:navigate
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-slate-300 dark:hover:bg-gray-700 group">
                        <svg
                            class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400
                        group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M3 2.25a.75.75 0 0 1 .75.75v.54l1.838-.46a9.75 9.75 0 0 1 6.725.738l.108.054A8.25 8.25 0 0 0 18 4.524l3.11-.732a.75.75 0 0 1 .917.81 47.784 47.784 0 0 0 .005 10.337.75.75 0 0 1-.574.812l-3.114.733a9.75 9.75 0 0 1-6.594-.77l-.108-.054a8.25 8.25 0 0 0-5.69-.625l-2.202.55V21a.75.75 0 0 1-1.5 0V3A.75.75 0 0 1 3 2.25Z"
                                  clip-rule="evenodd" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Brand</span>

                    </a>
                </li>
            @endcan
            <li>
                <a href="{{ route('admin.product.index') }}" wire:navigate
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-slate-300 dark:hover:bg-gray-700 group">
                    <svg
                        class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400
                        group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10.5 18.75a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" />
                        <path fill-rule="evenodd"
                              d="M8.625.75A3.375 3.375 0 0 0 5.25 4.125v15.75a3.375 3.375 0 0 0 3.375 3.375h6.75a3.375 3.375 0 0 0 3.375-3.375V4.125A3.375 3.375 0 0 0 15.375.75h-6.75ZM7.5 4.125C7.5 3.504 8.004 3 8.625 3H9.75v.375c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125V3h1.125c.621 0 1.125.504 1.125 1.125v15.75c0 .621-.504 1.125-1.125 1.125h-6.75A1.125 1.125 0 0 1 7.5 19.875V4.125Z"
                              clip-rule="evenodd" />
                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap">Products</span>
                </a>
            </li>
            {{--            <li>--}}
            {{--                <a href="#"--}}
            {{--                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-slate-300 dark:hover:bg-gray-700 group">--}}
            {{--                    <svg--}}
            {{--                        class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"--}}
            {{--                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">--}}
            {{--                        <path--}}
            {{--                            d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />--}}
            {{--                    </svg>--}}
            {{--                    <span class="flex-1 ml-3 whitespace-nowrap">Inbox</span>--}}
            {{--                    <span--}}
            {{--                        class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}

            @can('user-list')
                <li class="inline-flex w-full items-center justify-end bg-blue-200 dark:bg-slate-900 px-4
                text-gray-900 rounded-lg dark:text-slate-300">
                    <span>Management</span>
                </li>
            @endcan
            @can('user-list')
                <li>
                    <a href="{{ route('admin.users.index') }}" wire:navigate
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-slate-300 dark:hover:bg-gray-700 group">
                        <svg
                            class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Users</span>
                    </a>
                </li>
            @endcan
            @can('role-list')
                <li>
                    <a href="{{ route('admin.roles.index') }}" wire:navigate
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-slate-300 dark:hover:bg-gray-700 group">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 96.000000 96.000000"
                             preserveAspectRatio="xMidYMid meet"
                             class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400
                    group-hover:text-gray-900 dark:group-hover:text-white">
                            <g transform="translate(0.000000,96.000000) scale(0.050000,-0.050000)" fill="currentColor"
                               stroke="none">
                                <path
                                    d="M390 1782 c-236 -103 -166 -452 90 -452 292 0 318 430 28 461 -43 5 -96 1 -118 -9z" />
                                <path
                                    d="M950 1782 c-236 -103 -166 -452 90 -452 292 0 318 430 28 461 -43 5 -96 1 -118 -9z" />
                                <path
                                    d="M163 1194 c-60 -65 -64 -496 -5 -624 82 -180 273 -253 462 -177 45 17 79 38 75 45 -94 171 -135 628 -68 767 30 62 -404 52 -464 -11z" />
                                <path
                                    d="M723 1194 c-108 -116 -47 -645 87 -751 78 -61 80 -58 81 92 2 254 177 457 427 497 99 16 115 90 36 165 -73 68 -566 66 -631 -3z" />
                                <path
                                    d="M1312 892 c-35 -83 -94 -118 -182 -108 -99 11 -152 -80 -91 -157 22 -29 41 -77 41 -107 0 -30 -19 -78 -41 -107 -61 -77 -8 -168 91 -157 88 10 147 -25 182 -108 41 -98 135 -98 176 0 35 83 94 118 182 108 99 -11 152 80 91 157 -52 67 -52 147 0 214 61 77 8 168 -91 157 -88 -10 -147 25 -182 108 -23 56 -39 68 -88 68 -49 0 -65 -12 -88 -68z m168 -292 c22 -22 40 -58 40 -80 0 -100 -128 -152 -200 -80 -22 22 -40 58 -40 80 0 22 18 58 40 80 22 22 58 40 80 40 22 0 58 -18 80 -40z" />
                            </g>
                        </svg>

                        <span class="flex-1 ml-3 whitespace-nowrap">Roles</span>
                    </a>
                </li>
            @endcan


            <li class="inline-flex w-full items-center justify-end bg-blue-200 dark:bg-slate-900 px-4
                text-gray-900 rounded-lg dark:text-slate-300">
                <span>CMS</span>
            </li>

            <li>
                <a href="{{ route('admin.slider.index') }}" wire:navigate
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-slate-300 dark:hover:bg-gray-700 group">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400
                    group-hover:text-gray-900 dark:group-hover:text-white">>
                        <path fill-rule="evenodd"
                              d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                              clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Slider</span>
                </a>
            </li>
            <li>
                <a href="#" wire:navigate
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-slate-300 dark:hover:bg-gray-700 group">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400
                    group-hover:text-gray-900 dark:group-hover:text-white">
                        <path fill-rule="evenodd"
                              d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z"
                              clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                              d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375Zm9.586 4.594a.75.75 0 0 0-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 0 0-1.06 1.06l1.5 1.5a.75.75 0 0 0 1.116-.062l3-3.75Z"
                              clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Home Page</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.store.info') }}" wire:navigate
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-slate-300 dark:hover:bg-gray-700 group">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400
                    group-hover:text-gray-900 dark:group-hover:text-white">
                        <path
                            d="M5.223 2.25c-.497 0-.974.198-1.325.55l-1.3 1.298A3.75 3.75 0 0 0 7.5 9.75c.627.47 1.406.75 2.25.75.844 0 1.624-.28 2.25-.75.626.47 1.406.75 2.25.75.844 0 1.623-.28 2.25-.75a3.75 3.75 0 0 0 4.902-5.652l-1.3-1.299a1.875 1.875 0 0 0-1.325-.549H5.223Z" />
                        <path fill-rule="evenodd"
                              d="M3 20.25v-8.755c1.42.674 3.08.673 4.5 0A5.234 5.234 0 0 0 9.75 12c.804 0 1.568-.182 2.25-.506a5.234 5.234 0 0 0 2.25.506c.804 0 1.567-.182 2.25-.506 1.42.674 3.08.675 4.5.001v8.755h.75a.75.75 0 0 1 0 1.5H2.25a.75.75 0 0 1 0-1.5H3Zm3-6a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75v-3Zm8.25-.75a.75.75 0 0 0-.75.75v5.25c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75v-5.25a.75.75 0 0 0-.75-.75h-3Z"
                              clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Store</span>
                </a>
            </li>


        </ul>
    </div>
</div>
