<section class="font-serif py-1 bg-gradient-to-l from-violet-100 via-indigo-100 to-cyan-100 ">
    <div class="flex justify-center items-center">
        <div class="container px-4 sm:px-11 lg:px-24 flex flex-row justify-between items-center">
            <div class="flex flex-row items-center space-x-4 sm:space-x-6">
                <a target="_blank" href="https://wa.me/+{!! $store['whatsapp']!!}"
                   class="text-sm inline-flex text-gray-600 hover:text-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M187.58,144.84l-32-16a8,8,0,0,0-8,.5l-14.69,9.8a40.55,40.55,0,0,1-16-16l9.8-14.69a8,8,0,0,0,.5-8l-16-32A8,8,0,0,0,104,64a40,40,0,0,0-40,40,88.1,88.1,0,0,0,88,88,40,40,0,0,0,40-40A8,8,0,0,0,187.58,144.84ZM152,176a72.08,72.08,0,0,1-72-72A24,24,0,0,1,99.29,80.46l11.48,23L101,118a8,8,0,0,0-.73,7.51,56.47,56.47,0,0,0,30.15,30.15A8,8,0,0,0,138,155l14.61-9.74,23,11.48A24,24,0,0,1,152,176ZM128,24A104,104,0,0,0,36.18,176.88L24.83,210.93a16,16,0,0,0,20.24,20.24l34.05-11.35A104,104,0,1,0,128,24Zm0,192a87.87,87.87,0,0,1-44.06-11.81,8,8,0,0,0-6.54-.67L40,216,52.47,178.6a8,8,0,0,0-.66-6.54A88,88,0,1,1,128,216Z">
                        </path>
                    </svg>
                    <span class="hidden sm:block">
                        {{ __($store['whatsapp']) }}
                   </span>
                </a>
                <a href="{!! $store['email'] !!}" target="_blank"
                   class="text-sm inline-flex text-gray-600 hover:text-gray-900">
                    <x-heroicons::outline.envelope class="mr-1 w-5 h-5" />
                    <span class="hidden sm:block">
                        {{ __($store['email']) }}
                     </span>
                </a>
            </div>
            <div class="flex flex-row items-center space-x-2 sm:space-x-6 print:hidden">
                <a href="#" target="_blank"
                   class="text-sm inline-flex rounded-lg px-1
                    text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                    <x-heroicons::outline.map-pin class="mr-1 h-5 w-5" />
                    {{ __('Find Us') }}
                </a>
                @if (auth()->user())
                    @if (auth()->user()->hasPermissionTo('dashboard'))
                        <a href="{{ route('admin.dashboard') }}" wire:navigate
                           class="text-sm inline-flex rounded-lg px-1
                    text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                            <x-heroicons::outline.cog class="mr-1 h-5 w-5" />
                            {{ __('Dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('profile.show') }}" wire:navigate
                           class="text-sm inline-flex rounded-lg px-1
                    text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                            <x-heroicons::outline.user class="mr-1 h-5 w-5" />
                            {{ __('Profile') }}
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" wire:navigate
                       class="text-sm inline-flex rounded-lg px-1
                    text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                        <x-heroicons::outline.user class="mr-1 h-5 w-5" />
                        {{ __('Login') }}
                    </a>
                @endif
            </div>
        </div>
    </div>


</section>
