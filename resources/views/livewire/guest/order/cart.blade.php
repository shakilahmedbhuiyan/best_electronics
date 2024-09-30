<section class="my-6">

    <div class="flex justify-between items-center max-w-4xl mx-auto bg-white rounded-lg p-5">
        <h2 class="text-2xl font-bold"> Shopping Cart</h2>
        <a href="{{ route('index') }}" class="text-emerald-700">Continue Shopping</a>
    </div>

    <!-- Cart Items -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full my-2">
        @if($cartItems !== null)
            <div class="w-full px-2 md:px-5 mx-auto bg-white rounded-lg" x-data="cartData()">
                <div class="hidden lg:grid grid-cols-2 py-6">
                    <div class="font-normal text-xl leading-8 text-gray-500">Product</div>
                    <p class="font-normal text-xl leading-8 text-gray-500 flex items-center justify-between">
                        <span class="w-full max-w-[260px] text-center">Quantity</span>
                        <span class="w-full max-w-[200px] text-center">Total</span>
                    </p>
                </div>

                <!-- Product List Loop -->
                <template x-for="(item, index) in items" :key="item.product.id">
                    <div class="grid grid-cols-1 lg:grid-cols-2 border-t border-gray-200 py-6">
                        <div
                            class="flex items-center flex-col min-[550px]:flex-row gap-3 min-[550px]:gap-6 w-full max-xl:justify-center max-xl:max-w-xl max-xl:mx-auto">
                            <div class="img-box">
                                <img :src="item.product.thumbnail" :alt="item.product.name"
                                     class="xl:w-[140px] rounded-xl object-cover">
                            </div>
                            <div class="w-full max-w-sm">
                                <h5 class="font-semibold text-xl text-black max-[550px]:text-center"
                                    x-text="item.product.name"></h5>
                                <p class="font-normal text-lg text-gray-500 my-2 max-[550px]:text-center"
                                   x-text="item.product.category.name"></p>
                                <h6 class="font-medium text-lg text-emerald-800 max-[550px]:text-center">
                                    SAR. <span
                                        x-text="item.product.sale ? item.product.sale_price : item.product.price"></span>
                                </h6>
                            </div>
                        </div>
                        <div
                            class="flex items-center flex-col min-[550px]:flex-row w-full max-xl:max-w-xl max-xl:mx-auto gap-2">
                            <!-- Quantity Input -->
                            <div class="flex items-center w-full mx-auto justify-center">
                                <input type="number" x-model.number="item.quantity"
                                       x-on:change="$wire.updateCartQuantity(item.product.id, item.quantity)"
                                       class="w-20" min="1">
                            </div>
                            <!-- Total Price for Each Item -->
                            <p class="text-emerald-950 font-bold text-2xl leading-9 w-full max-w-[176px] text-center">
                                SAR. <span x-text="calculateItemTotal(item)"></span>
                            </p>
                        </div>
                    </div>
                </template>

                <!-- Total -->
                <div class="bg-gray-200 rounded-xl p-6 w-full mb-8">
                    <div class="flex items-center justify-between w-full py-6">
                        <p class="font-medium text-2xl leading-9 text-gray-900">Total</p>
                        <h6 class="font-bold text-2xl leading-9 text-emerald-950" x-text="totalPrice()"></h6>
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-col col-span-full items-center justify-center w-full h-96">
                <x-empty-cart class="h-96 aspect-video object-cover drop-shadow-lg" />
                <h2 class="text-2xl font-semibold text-gray-500">No items in cart</h2>
                <a href="{{ route('index') }}" class="text-emerald-700">Start Shopping</a>
            </div>
        @endif
        <!-- Buttons -->
            <form wire:submit.prevent="order" class="w-full px-2 md:px-5 mx-auto bg-white rounded-lg ">
               <h4 class="text-center font-bold text-lg"> Customer Information's: </h4>
                <div class="flex flex-col space-y-3">
                    <x-input wire:model="customer.name"
                             type="text" placeholder="Name" label="Name"/>
                    <x-input wire:model="customer.email" type="email" placeholder="Email" label="Email"/>
                    <x-input wire:model="customer.phone" type="text" placeholder="Phone" label="Phone"/>
                    <x-input wire:model="customer.address" type="text" placeholder="Address" label="Address"/>
                    <x-input wire:model="customer.city" type="text" placeholder="City" label="City"/>
                    <x-input wire:model="customer.photoId" type="text" placeholder="ID Number"
                             label="ID Number"/>
                </div>
                <div class="flex items-center flex-col sm:flex-row justify-center gap-3 mt-8">
            <button wire:click="checkout()"
                    class="rounded-full w-full max-w-[280px] py-4 text-center justify-center items-center bg-indigo-600 font-semibold text-lg text-white flex transition-all duration-500 hover:bg-indigo-700">
                Place Order
                <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22"
                     fill="none">
                    <path d="M8.75324 5.49609L14.2535 10.9963L8.75 16.4998" stroke="white" stroke-width="1.6"
                          stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
            </form>

    </div>

</section>
<script>
    function cartData() {
        return {
            items: @json($cartItems),  // Pass your PHP cartItems to Alpine.js
            // updateItemQuantity(index) {
            //     const item = this.items[index];
            //     // Send an event to Livewire to update the quantity in the session
            //     $dispatch('updateCartQuantity', item.product.id, item.quantity);
            // },
            calculateItemTotal(item) {
                // Calculate the total price of each item based on the quantity and price
                const price = item.product.sale ? item.product.sale_price : item.product.price;
                return (price * item.quantity).toFixed(2);
            },
            totalPrice() {
                // Calculate the total price of all items in the cart
                return this.items.reduce((total, item) => {
                    const price = item.product.sale ? item.product.sale_price : item.product.price;
                    return total + (price * item.quantity);
                }, 0).toFixed(2);
            },
        };
    }
</script>
