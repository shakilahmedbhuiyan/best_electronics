<nav class="fixed top-0 z-10 w-full bg-white border-b border-gray-200 dark:bg-slate-800 dark:border-slate-700"
 @mouseleave.away="sidebar = false">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button type="button" @click="sidebar = !sidebar"
                        @mouseover="sidebar = true"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100
                    focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="{{ route('index') }}" class="inline-flex justify-center items-center md:mr-24">
                    <x-application-logo class="block w-auto h-10 text-blue-800 dark:text-gray-200 fill-current" />
                    <h1 class="flex flex-col pl-2 font-bold text-[1.3rem] leading-none text-emerald-900 dark:text-emerald-300">
                        Best
                        <span class="font-light">Electronics</span>
                    </h1>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ml-3 space-x-3" x-data="darkMode"
                     :class="{ 'dark': darkMode }">
                    <!-- Dark Mode Toggle -->
                    <button @click="toggle" type="button"
                            class="text-yellow-400 dark:text-indigo-600 hover:text-indigo-600 dark:hover:text-yellow-400
                            rounded-lg text-sm mx-4 px-2 flex justify-center items-center ">
                        <!-- Dark Mode Icon -->
                        <svg x-show="!darkMode" class="w-6 h-6 rotate-90 hover:rotate-0 transition-all duration-150"
                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <!-- Light Mode Icon -->
                        <svg x-show="darkMode" class="w-6 h-6 hover:rotate-90 transition-all duration-150"
                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div>

                        <x-dropdown>
                            <x-slot name="trigger">
                                <button type="button"
                                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300
                                        dark:focus:ring-gray-600">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-8 h-8 rounded-full"
                                         src="{{ Auth::user()->profile_photo_path ? asset(Auth::user()->profile_photo_path) : Auth::user()->profile_photo_url }}"
                                         alt="{{ Auth::user()->name }}">
                                </button>
                            </x-slot>
                            <x-dropdown.header label="{{ auth()->user()->name }}">
                                <p class="text-gray-900 truncate dark:text-gray-300">
                                    {{ auth()->user()->email }}
                                </p>
                            </x-dropdown.header>
                            <x-dropdown.item separator icon="user" label="My Profile"
                                             href="{{ route('profile.show') }}" wire:navigate />

                            <x-dropdown.item icon="rectangle-group" label="Dashboard"
                                             href="{{ route('admin.dashboard') }}" wire:navigate />


                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown.item icon="lock-closed" label="Logout" href="{{ route('logout') }}"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                </x-dropdown.item>
                            </form>

                        </x-dropdown>

                    </div>

                </div>
            </div>
        </div>
    </div>

</nav>
