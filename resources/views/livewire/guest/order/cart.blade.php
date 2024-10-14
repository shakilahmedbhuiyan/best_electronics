<section class="mt-6 pb-6 ">

    <div class="flex justify-between items-center max-w-4xl mx-auto
    bg-emerald-50 dark:bg-slate-900 drop-shadow-lg rounded-lg p-5">
        <h2 class="text-2xl font-bold text-gray-400 "> Shopping Cart</h2>
        <a href="{{ route('index') }}" class="text-emerald-700" wire:navigate>Continue Shopping</a>
    </div>

    <!-- Cart Items -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full my-2 px-4">
        @if($cartItems !== null && count($cartItems) > 0)
            <div class="w-full px-2 md:px-5 mx-auto bg-slate-50 dark:bg-slate-900 rounded-lg shadow-lg" x-data="cartData()">
                <div class="hidden lg:grid grid-cols-2 py-6 text-gray-500 dark:text-gray-400">
                    <div class="font-normal text-xl leading-8">Product</div>
                    <p class="font-normal text-xl leading-8 flex items-center justify-between">
                        <span class="w-full max-w-[260px] text-center">Quantity</span>
                        <span class="w-full max-w-[200px] text-center">Total</span>
                    </p>
                </div>

                <!-- Product List Loop -->
                <template x-for="(item, index) in items" :key="item.product.id">
                    <div class="grid grid-cols-1 lg:grid-cols-2 border-t border-gray-200 py-6">
                        <div
                            class="flex items-center flex-col md:flex-row gap-3 w-full max-xl:justify-center max-xl:max-w-xl max-xl:mx-auto">
                            <div class="img-box">
                                <img :src="item.product.thumbnail" :alt="item.product.name"
                                     class="h-40 aspect-square rounded-xl object-contain">
                            </div>
                            <div class="w-full max-w-sm text-slate-900 dark:text-slate-200">
                                <h5 class="text-lg text-center sm:text-start"
                                    x-text="item.product.name"></h5>
                                <p class="text-sm opacity-70 mb-1 text-center sm:text-start"
                                   x-text="item.product.category.name"></p>
                                <h6 class="font-medium text-md text-emerald-800
                                dark:text-emerald-400 text-center sm:text-start">
                                    <span class="text-sm opacity-70"></span>
                                    <span x-text="item.product.sale ? item.product.sale_price : item.product.price"></span>
                                </h6>
                                <div class="text-sm flex md:inline-flex justify-center items-center text-orange-600/85"
                                     x-show="item.product.instalment">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="currentColor"
                                         class="h-8 w-8">
                                        <path
                                            d="M28,41H6c-1.1,0-2-.9-2-2v-22h34v5c0,.55.45,1,1,1s1-.45,1-1v-11c0-2.21-1.79-4-4-4h-2v-1c0-.55-.45-1-1-1s-1,.45-1,1v1h-4v-1c0-.55-.45-1-1-1s-1,.45-1,1v1h-4v-1c0-.55-.45-1-1-1s-1,.45-1,1v1h-4v-1c0-.55-.45-1-1-1s-1,.45-1,1v1h-4v-1c0-.55-.45-1-1-1s-1,.45-1,1v1h-2c-2.21,0-4,1.79-4,4v28c0,2.21,1.79,4,4,4h22c.55,0,1-.45,1-1s-.45-1-1-1ZM6,9h2v2c0,.55.45,1,1,1s1-.45,1-1v-2h4v2c0,.55.45,1,1,1s1-.45,1-1v-2h4v2c0,.55.45,1,1,1s1-.45,1-1v-2h4v2c0,.55.45,1,1,1s1-.45,1-1v-2h4v2c0,.55.45,1,1,1s1-.45,1-1v-2h2c1.1,0,2,.9,2,2v4H4v-4c0-1.1.9-2,2-2Z" />
                                        <path
                                            d="M37 25c-4.96 0-9 4.04-9 9s4.04 9 9 9 9-4.04 9-9-4.04-9-9-9zM37 41c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM14 22c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-4zM12 25h-2v-2h2v2zM13 31h-4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1zM12 35h-2v-2h2v2zM24 22c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-4zM22 25h-2v-2h2v2zM23 31h-4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1zM22 35h-2v-2h2v2zM29 21c-.55 0-1 .45-1 1v3.07c0 .55.45 1 1 1s1-.45 1-1v-2.07h2.05c.13.4.51.69.95.69.55 0 1-.45 1-1v-.69c0-.55-.45-1-1-1h-4z" />
                                        <path
                                            d="M39.29,30.29l-6,6c-.39.39-.39,1.02,0,1.41.2.2.45.29.71.29s.51-.1.71-.29l6-6c.39-.39.39-1.02,0-1.41s-1.02-.39-1.41,0Z" />
                                        <circle cx="34.5" cy="31.5" r="1.5" />
                                        <circle cx="39.5" cy="36.5" r="1.5" />
                                    </svg>
                                    {!! "EMI" !!}
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex items-center flex-col md:flex-row w-full max-xl:max-w-xl max-xl:mx-auto gap-2">
                            <!-- Quantity Input -->
                            <div class="flex items-center w-20 mx-auto justify-center">
                                <x-input type="number" x-model.number="item.quantity"
                                             x-on:change="$wire.updateCartQuantity(item.product.id, item.quantity)"
                                             min="1" />
                            </div>
                            <!-- Total Price for Each Item -->
                            <p class="text-emerald-800 dark:text-emerald-500 font-bold text-lg leading-3 w-full
                            max-w-[176px] text-center">
                                <span class="text-sm">{{__('SAR.')}}</span>
                                <span x-text="calculateItemTotal(item)"></span>
                            </p>
                        </div>
                    </div>
                </template>

                <!-- Total -->
                <div class="bg-gray-200 dark:bg-gray-800 rounded-xl px-6 w-full mb-8">
                    <div class="flex items-center justify-between w-full py-6 text-emerald-800 dark:text-emerald-500">
                        <p class="font-medium text-2xl leading-6 ">Total</p>
                        <h6 class="font-bold text-2xl leading-6" x-text="totalPrice()"></h6>
                    </div>
                </div>
            </div>

            <!-- Customer Form -->
            <form wire:submit.prevent="checkout()"
                  class="w-full px-2 md:px-5 mx-auto bg-slate-50 dark:bg-slate-900 rounded-lg shadow-lg py-4">
                <h4 class="text-center font-bold text-lg font-serif text-emerald-900 dark:text-emerald-500">
                {{ __("Order Information's:") }}
                </h4>
                <div class="flex flex-col space-y-3">
                    <x-input wire:model.defer="customer.name" required
                             type="text" placeholder="Name" label="Name" />
                    <x-phone wire:model.defer="customer.mobile" type="text" placeholder="Mobile" label="Mobile"
                             required corner="Whatsapp preferred"
                             :mask="['(#)## ###-####','+### ###-####', '+### ### ###-####']" />
                    <x-maskable wire:model.defer="customer.id_no" type="text" placeholder="ID Number"
                                label="ID Number" required
                                mask="### ### ####" corner=" نفاذ | NAFATH" />

                    <div class=" grid grid-col-1 md:grid-cols-2 gap-3" id="listing">
                        <x-select label="Nationality" placeholder="Select Nationality"
                                  wire:model.defer="customer.nationality"
                                  :async-data=" route('country.search')"
                                  :template="[
                                    'name' => 'user-option',
                                   'config' => ['src' => 'flag'],
                                   ]"
                                  option-label="name"
                                  option-value="value"
                                  option-description="official" />
                        <x-datetime-picker
                            wire:model.defer="customer.dob"
                            label="Date of Birth"
                            placeholder="Date of Birth"
                            without-time
                            :max="now()->subYears(18)->format('d-m-Y')"
                        />
                    </div>
                </div>
                <div class="flex items-center flex-col sm:flex-row justify-center gap-3 mt-8">
                    <button type="submit" class="rounded-full w-full max-w-[280px] py-4 text-center justify-center items-center
                    bg-emerald-900 font-semibold text-lg text-white flex transition-all duration-300 hover:bg-emerald-950">
                        {{ __(' Place Order') }}
                        <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22"
                             fill="none">
                            <path d="M8.75324 5.49609L14.2535 10.9963L8.75 16.4998" stroke="white" stroke-width="1.6"
                                  stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </form>
        @else
            <div class="flex flex-col col-span-full items-center justify-center w-full h-96">
                <x-empty-cart class="h-96 aspect-video object-cover drop-shadow-lg" />
                <h2 class="text-2xl font-semibold text-gray-500">No items in cart</h2>
                <a href="{{ route('index') }}" class="text-emerald-600 dark:text-emerald-500" wire:navigate>Start Shopping</a>
            </div>
        @endif
    </div>

</section>
@push('scripts')
    <script>
        function cartData() {
            return {
                items: @json($cartItems),
                calculateItemTotal(item) {
                    const price = item.product.sale ? item.product.sale_price : item.product.price
                    return (price * item.quantity).toFixed(2)
                },
                totalPrice() {
                    return this.items.reduce((total, item) => {
                        const price = item.product.sale ? item.product.sale_price : item.product.price
                        return total + (price * item.quantity)
                    }, 0).toFixed(2)
                },
            }
        }
    </script>
@endpush
