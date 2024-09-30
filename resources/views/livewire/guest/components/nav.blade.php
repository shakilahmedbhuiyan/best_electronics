<section x-data="{navbarOpen: false, sticky: false}"
         x-cloak class="relative w-full mb-2">

    <nav @scroll.window="sticky = (window.scrollY > 10)"
         :class="{'absolute w-full sm:py-0': sticky, 'relative w-full': !sticky}"
         class="px-8 flex sm:justify-around justify-between items-center bg-white drop-shadow-lg rounded-md top-0"
         x-data="{mobile : false}"
         x-init=" width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
          mobile= (width > 769)? true : false"
         @resize.window=" width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
         mobile= (width > 769)? true : false">

        <div class="inline-flex justify-center items-center leading-none ">
            <x-application-mark href="{{ route('index') }}" alt="{{ config('app.name') }}"
                                class="h-12 w-12 py-0" fill="currentColor" />
            <h1 class="flex flex-col pl-2 font-bold text-[1.3rem] leading-none text-emerald-900">
                Best
                <span class="font-light">Electronics</span>
            </h1>
        </div>

        <!-- web navbar -->
        <div class="flex flex-row justify-between items-center">
            <!-- mobile navbar button -->
            <div class="inline-flex justify-center items-center" x-show="!mobile">
                <!-- mobile search button -->
                <button type="button" class="navbar-burger flex items-center justify-end"
                        @click="$openModal('searchModal')">
                    <x-heroicons::outline.magnifying-glass
                        class="h-12 w-12 p-2 text-emerald-900 hover:bg-emerald-900 hover:text-gray-200" />

                </button>
                <!-- mobile navbar button -->
                <button type="button" class="navbar-burger flex items-center justify-end"
                        @click="navbarOpen = ! navbarOpen">
                    <x-heroicons::outline.bars-3-bottom-right x-show="!navbarOpen"
                                                              class="h-12 w-12 p-2 text-emerald-900 hover:bg-emerald-900 hover:text-gray-200" />
                    <x-heroicons::outline.x-mark x-show="navbarOpen"
                                                 class="h-12 w-12 p-2 text-emerald-900 hover:bg-emerald-900 hover:text-gray-200" />
                </button>
            </div>

            <!-- web navbar links -->
            <div x-show="mobile">
                <ul class="flex flex-row justify-center items-center text-emerald-900">
                    @foreach($navLinks as $item)
                        <li class="hover:bg-emerald-900 hover:text-white @isset($item['dropdown']) hoverable
                        @endisset"
                            wire:key="{{ $item['id'] }}">
                            <x-web-link route="{{$item['route']}}"
                                        title="{{$item['name']}}"
                                        id="{{ '#dropdown'.$item['id'] }}"
                                        type="{{$item['type']}}" />

                        </li>

                    @endforeach

                </ul>

            </div>
            <!-- web navbar links end -->
        </div>

        <!-- web navbar button -->
        <div class="space-x-2 inline-flex" x-show="mobile">
            <a href="#" class="md:inline-block transition duration-200">
                <x-button type="button" variant="flat" x-on:click="$openModal('searchModal')" >
                    <x-heroicons::outline.magnifying-glass class="h-6 w-6 text-emerald-800" />
                </x-button>

                <a href="{{ route('cart') }}" class="md:inline-block transition duration-200">
                    <x-button type="button" flat class="hover:outline">
                        <x-heroicons::outline.shopping-bag class="h-6 w-6 text-emerald-800" />
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-800"
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
            <div class="flex items-center justify-center mb-8 font-sans space-x-4 w-full">
                <a class="mx-auto text-3xl font-bold leading-none inline-flex justify-center items-center w-full"
                   href="{{ route('index') }}" wire:navigate>
                    <x-application-logo class="h-12" />
                    <h1 class="inline-flex pl-2">
                        Best
                        <span class="font-light">Electronics</span>

                    </h1>
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
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-emerald-200 hover:text-emerald-800 rounded"
                           href="{{ route('index') }}" wire:navigate>Home</a>
                    </li>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-emerald-200 hover:text-emerald-800 rounded"
                           href="#">Products</a>
                    </li>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-emerald-200 hover:text-emerald-800 rounded"
                           href="#">About Us</a>
                    </li>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-emerald-200 hover:text-emerald-800 rounded"
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
                        <a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-emerald-600 hover:bg-emerald-700  rounded-xl"
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
