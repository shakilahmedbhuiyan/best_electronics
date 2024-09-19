<section x-data="{navbarOpen: false, sticky: false}"
         x-cloak class="relative w-full">

    <nav @scroll.window="sticky = (window.scrollY > 10)"
         :class="{'absolute w-full sm:py-0': sticky, 'relative w-full': !sticky}"
         class="px-8 flex sm:justify-around justify-between items-center bg-white drop-shadow-lg rounded-md top-0"
         x-data="{mobile : false}"
         x-init=" width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
          mobile= (width > 769)? true : false"
         @resize.window=" width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
         mobile= (width > 769)? true : false">

        <x-application-mark href="{{ route('index') }}" alt="{{ config('app.name') }}"
                            class="h-12 w-12 sm:py-0 py-2 text-blue-800" fill="currentColor" />

        <!-- web navbar -->
        <div class="flex flex-row justify-between items-center">
            <!-- mobile navbar button -->
            <div class="inline-flex justify-center items-center" x-show="!mobile">
                <!-- mobile search button -->
                <button type="button" class="navbar-burger flex items-center justify-end"
                        @click="$openModal('searchModal')">
                    <x-heroicons::outline.magnifying-glass
                        class="h-12 w-12 p-2 text-blue-800 hover:bg-blue-800 hover:text-gray-200" />

                </button>
                <!-- mobile navbar button -->
                <button type="button" class="navbar-burger flex items-center justify-end"
                        @click="navbarOpen = ! navbarOpen">
                    <x-heroicons::outline.bars-3-bottom-right x-show="!navbarOpen"
                                                              class="h-12 w-12 p-2 text-blue-800 hover:bg-blue-800 hover:text-gray-200" />
                    <x-heroicons::outline.x-mark x-show="navbarOpen"
                                                 class="h-12 w-12 p-2 text-blue-800 hover:bg-blue-800 hover:text-gray-200" />
                </button>
            </div>

            <!-- web navbar links -->
            <div x-show="mobile">
                <ul class="flex flex-row justify-center items-center text-blue-800">
                    @foreach($navLinks as $item)

                        <li class="hover:bg-blue-800 hover:text-white @isset($item['dropdown']) hoverable
                        @endisset" wire:key="{{ $item['id'] }}">
                            {{--                            <a class="relative block py-6 px-4 text-sm lg:text-base  hover:bg-blue-800--}}
                            {{--                            @if(Route::currentRouteName()=== $item['route'])text-blue-700 hover:text-white font-bold--}}
                            {{--                            @endif" id="{{ "#dropdown".$item['id'] }}" wire:navigate--}}
                            {{--                               href="{{  route($item['route'])  }}">--}}
                            {{--                                {{ $item['name'] }} </a>--}}
                            <x-web-link route="{{$item['route']}}"
                                        title="{{$item['name']}}"
                                        id="{{ '#dropdown'.$item['id'] }}"
                                        type="{{$item['type']}}" />

                            @isset($item['dropdown'])
                                <div class="p-6 mega-menu mb-16 sm:mb-0 shadow-xl bg-blue-800"
                                     wire:key="{{ "#dropdown".$item['id'] }}">
                                    <div class="container w-full flex flex-wrap justify-between mx-2">
                                        <div class="w-full text-white mb-8">
                                            <h2 class="font-bold text-2xl"> {{ $item['name'] }}</h2>
                                            <p>
                                                {{ "Category Description" }}
                                            </p>
                                        </div>
                                        @foreach($item['dropdown'] as $key=>$ditem )
                                            <div class="px-4 w-full sm:w-1/2 lg:w-1/4 border-gray-600 border-b
                                            sm:border-r lg:border-b-0 pb-6 pt-6 lg:pt-3">
                                                <div class="flex items-center">
                                                    <svg class="h-8 mb-3 mr-3 fill-current text-white"
                                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path
                                                            d="M3 6c0-1.1.9-2 2-2h8l4-4h2v16h-2l-4-4H5a2 2 0 0 1-2-2H1V6h2zm8 9v5H8l-1.67-5H5v-2h8v2h-2z" />
                                                    </svg>
                                                    <h3 class="font-bold text-xl text-white text-bold mb-2">
                                                        {{ ($ditem['name']) }}
                                                    </h3>
                                                </div>
                                                <p class="text-gray-100 text-sm"> Quarterly sales are at an all-time low
                                                    create
                                                    spaces to explore the accountable talk and blind vampires.</p>
                                                <div class="flex items-center py-3">
                                                    <svg class="h-6 pr-3 fill-current text-blue-300"
                                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path
                                                            d="M20 10a10 10 0 1 1-20 0 10 10 0 0 1 20 0zm-2 0a8 8 0 1 0-16 0 8 8 0 0 0 16 0zm-8 2H5V8h5V5l5 5-5 5v-3z" />
                                                    </svg>
                                                    <a href="#"
                                                       class="text-white bold border-b-2 border-blue-300 hover:text-blue-300">Find
                                                        out more...</a>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>

                            @endisset
                        </li>

                    @endforeach

                    <!--Hoverable Link -->
                    <li class="hoverable hover:bg-blue-800 hover:text-white">
                        <a href="#" class="relative block py-6 px-4  text-sm lg:text-base  hover:bg-blue-800
                         hover:text-white">Hover</a>
                        <div class="p-6 mega-menu mb-16 sm:mb-0 shadow-xl bg-blue-800">
                            <div class="container w-full flex flex-wrap justify-between mx-2">
                                <div class="w-full text-white mb-8">
                                    <h2 class="font-bold text-2xl">Main Hero Message for the menu section</h2>
                                    <p>Sub-hero message, not too long and not too short. Make it just right!</p>
                                </div>
                                <ul class="px-4 w-full sm:w-1/2 lg:w-1/4 border-gray-600 border-b sm:border-r lg:border-b-0 pb-6 pt-6 lg:pt-3">
                                    <div class="flex items-center">
                                        <svg class="h-8 mb-3 mr-3 fill-current text-white"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M3 6c0-1.1.9-2 2-2h8l4-4h2v16h-2l-4-4H5a2 2 0 0 1-2-2H1V6h2zm8 9v5H8l-1.67-5H5v-2h8v2h-2z" />
                                        </svg>
                                        <h3 class="font-bold text-xl text-white text-bold mb-2">Heading 1</h3>
                                    </div>
                                    <p class="text-gray-100 text-sm">Quarterly sales are at an all-time low create
                                        spaces to explore the accountable talk and blind vampires.</p>
                                    <div class="flex items-center py-3">
                                        <svg class="h-6 pr-3 fill-current text-blue-300"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M20 10a10 10 0 1 1-20 0 10 10 0 0 1 20 0zm-2 0a8 8 0 1 0-16 0 8 8 0 0 0 16 0zm-8 2H5V8h5V5l5 5-5 5v-3z" />
                                        </svg>
                                        <a href="#"
                                           class="text-white bold border-b-2 border-blue-300 hover:text-blue-300">Find
                                            out more...</a>
                                    </div>
                                </ul>
                                <ul class="px-4 w-full sm:w-1/2 lg:w-1/4 border-gray-600 border-b sm:border-r-0 lg:border-r lg:border-b-0 pb-6 pt-6 lg:pt-3">
                                    <div class="flex items-center">
                                        <svg class="h-8 mb-3 mr-3 fill-current text-white"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M4.13 12H4a2 2 0 1 0 1.8 1.11L7.86 10a2.03 2.03 0 0 0 .65-.07l1.55 1.55a2 2 0 1 0 3.72-.37L15.87 8H16a2 2 0 1 0-1.8-1.11L12.14 10a2.03 2.03 0 0 0-.65.07L9.93 8.52a2 2 0 1 0-3.72.37L4.13 12zM0 4c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4z" />
                                        </svg>
                                        <h3 class="font-bold text-xl text-white text-bold mb-2">Heading 2</h3>
                                    </div>
                                    <p class="text-gray-100 text-sm">Prioritize these line items game-plan draw a
                                        line
                                        in the sand come up with something buzzworthy UX upstream selling.</p>
                                    <div class="flex items-center py-3">
                                        <svg class="h-6 pr-3 fill-current text-blue-300"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M20 10a10 10 0 1 1-20 0 10 10 0 0 1 20 0zm-2 0a8 8 0 1 0-16 0 8 8 0 0 0 16 0zm-8 2H5V8h5V5l5 5-5 5v-3z" />
                                        </svg>
                                        <a href="#"
                                           class="text-white bold border-b-2 border-blue-300 hover:text-blue-300">Find
                                            out more...</a>
                                    </div>
                                </ul>
                                <ul class="px-4 w-full sm:w-1/2 lg:w-1/4 border-gray-600 border-b sm:border-b-0 sm:border-r md:border-b-0 pb-6 pt-6 lg:pt-3">
                                    <div class="flex items-center">
                                        <svg class="h-8 mb-3 mr-3 fill-current text-white"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M2 4v14h14v-6l2-2v10H0V2h10L8 4H2zm10.3-.3l4 4L8 16H4v-4l8.3-8.3zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z" />
                                        </svg>
                                        <h3 class="font-bold text-xl text-white text-bold mb-2">Heading 3</h3>
                                    </div>
                                    <p class="text-gray-100 text-sm">This proposal is a win-win situation which will
                                        cause a stellar paradigm shift, let's touch base off-line before we fire the
                                        new
                                        ux experience.</p>
                                    <div class="flex items-center py-3">
                                        <svg class="h-6 pr-3 fill-current text-blue-300"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M20 10a10 10 0 1 1-20 0 10 10 0 0 1 20 0zm-2 0a8 8 0 1 0-16 0 8 8 0 0 0 16 0zm-8 2H5V8h5V5l5 5-5 5v-3z" />
                                        </svg>
                                        <a href="#"
                                           class="text-white bold border-b-2 border-blue-300 hover:text-blue-300">Find
                                            out more...</a>
                                    </div>
                                </ul>
                                <ul class="px-4 w-full sm:w-1/2 lg:w-1/4 border-gray-600 pb-6 pt-6 lg:pt-3">
                                    <div class="flex items-center">
                                        <svg class="h-8 mb-3 mr-3 fill-current text-white"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M9 12H1v6a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-6h-8v2H9v-2zm0-1H0V5c0-1.1.9-2 2-2h4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1h4a2 2 0 0 1 2 2v6h-9V9H9v2zm3-8V2H8v1h4z" />
                                        </svg>
                                        <h3 class="font-bold text-xl text-white text-bold mb-2">Heading 4</h3>
                                    </div>
                                    <p class="text-gray-100 text-sm">This is a no-brainer to wash your face, or we
                                        need
                                        to future-proof this high performance keywords granularity.</p>
                                    <div class="flex items-center py-3">
                                        <svg class="h-6 pr-3 fill-current text-blue-300"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M20 10a10 10 0 1 1-20 0 10 10 0 0 1 20 0zm-2 0a8 8 0 1 0-16 0 8 8 0 0 0 16 0zm-8 2H5V8h5V5l5 5-5 5v-3z" />
                                        </svg>
                                        <a href="#"
                                           class="text-white bold border-b-2 border-blue-300 hover:text-blue-300">Find
                                            out more...</a>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <!--  ## Hoverable Link Template ## -->

                </ul>

            </div>
            <!-- web navbar links end -->
        </div>

        <!-- web navbar button -->
        <div class="space-x-2 inline-flex" x-show="mobile">
            <a href="#" class="md:inline-block transition duration-200">
                <x-button type="button" variant="flat" x-on:click="$openModal('searchModal')">
                    <x-heroicons::outline.magnifying-glass class="h-6 w-6 text-blue-600" />
                </x-button>

                <a href="#" class="md:inline-block transition duration-200">
                    <x-button type="button" flat class="hover:outline">
                        <x-heroicons::outline.shopping-bag class="h-6 w-6 text-blue-600" />
                    </x-button>
                </a>
                @if( auth()->user() )
                    <form method="POST" action="{{ route('logout') }}"
                          class="md:inline-block transition duration-200">
                        @csrf
                        <a href="{{ route('logout') }}" wire:navigate
                           onClick="event.preventDefault();
                                                this.closest('form').submit();">
                            <x-button type="button" flat class="hover:outline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600"
                                     fill="currentColor"
                                     viewBox="0 0 256 256">
                                    <path
                                        d="M124,216a12,12,0,0,1-12,12H48a12,12,0,0,1-12-12V40A12,12,0,0,1,48,28h64a12,12,0,0,1,0,24H60V204h52A12,12,0,0,1,124,216Zm108.49-96.49-40-40a12,12,0,0,0-17,17L195,116H112a12,12,0,0,0,0,24h83l-19.52,19.51a12,12,0,0,0,17,17l40-40A12,12,0,0,0,232.49,119.51Z"></path>
                                </svg>
                            </x-button>
                        </a>
                    </form>
            @endif
        </div>
        <!--  web navbar button end  -->
    </nav>


    <!-- off-canvas menu -->
    <div x-cloak class="relative z-50" x-show="navbarOpen">
        <div class="navbar-backdrop backdrop-blur fixed inset-0 bg-gray-800 opacity-60"></div>
        <nav @click.outside="navbarOpen=false"
             class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
            <div class="flex items-center mb-8">
                <a class="mr-auto text-3xl font-bold leading-none" href="{{ route('index') }}" wire:navigate>
                    <x-application-logo class="h-12 text-blue-800" fill="currentColor" />
                </a>
                <button class="navbar-close" @click="navbarOpen=false">
                    <svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div>
                <ul>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-200 hover:text-blue-600 rounded"
                           href="{{ route('index') }}" wire:navigate>Home</a>
                    </li>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-200 hover:text-blue-600 rounded"
                           href="#">Products</a>
                    </li>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-200 hover:text-blue-600 rounded"
                           href="#">About Us</a>
                    </li>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-200 hover:text-blue-600 rounded"
                           href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="mt-auto">
                @if( auth()->user() )
                    @if(auth()->user()->hasPermissionTo('dashboard'))
                        <a class="block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold bg-gray-50 hover:bg-gray-100 rounded-xl"
                           href="{{ route('admin.dashboard') }}">
                            <x-button type="button">Dashboard</x-button>
                        </a>
                    @else
                        <a class="block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold bg-gray-50 hover:bg-gray-100 rounded-xl"
                           href="{{ route('profile.show') }}">
                            <x-button type="button">My Account</x-button>
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold bg-gray-50 hover:bg-gray-100 rounded-xl"
                           href="{{ route('logout') }}"
                           onClick="event.preventDefault();
                                    this.closest('form').submit();">
                            <x-button type="button">Logout</x-button>
                        </a>
                    </form>
                @else
                    <div class="pt-6">
                        <a class="block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold bg-gray-50 hover:bg-gray-100 rounded-xl"
                           href="{{ route('login') }}">
                            Sign in
                        </a>
                        <a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700  rounded-xl"
                           href="{{ route('register') }}">Sign Up</a>
                    </div>
                @endif
                <p class="my-4 text-xs text-center text-gray-400">
                    <span>Copyright © {{ date('Y') }}</span>
                </p>
            </div>
        </nav>
    </div>


    @livewire('guest.components.search-modal')
</section>
