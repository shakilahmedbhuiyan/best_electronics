<div class="min-h-screen">
    <livewire:guest.components.home-slider />
    <x-public.banner.buy-now />
    <livewire:guest.components.latest-devices />
    <livewire:guest.components.featured-brands />
    @livewire('guest.components.apple-devices', ['brand' => 'apple'])
</div>
