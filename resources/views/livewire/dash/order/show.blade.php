<section x-data>
    <x-slot name="button">
        <div class="flex flex-row justify-center items-center space-x-3 w-full" id="listing">
            <x-select class="w-40"
                      :options="[
    ['name' => 'Pending', 'id' => 'pending', 'description' => 'Order is pending'],
    ['name' => 'Processing', 'id' => 'processing', 'description' => 'Order is processing'],
    ['name' => 'Completed', 'id' => 'completed', 'description' => 'Order is completed'],
    ['name' => 'Refunded', 'id' => 'refunded', 'description' => 'Order is refunded'],
    ['name' => 'Shipped', 'id' => 'shipped', 'description' => 'Order is shipped'],
    ['name' => 'Cancelled', 'id' => 'cancelled', 'description' => 'Order is cancelled'],
    ]"
                      wire:model.live="status"
                      placeholder="Select status"
                      x-on:blur="$wire.updatedStatus()"
                      option-label="name"
                      option-value="id" />

            <a href="{{ route('admin.order.index') }}">
                <x-button-1>Back</x-button-1>
            </a>
        </div>


    </x-slot>

    <div class="my-4 w-full">

        <div class="mt-8 mb-12 print:mt-3 print:mb-1 px-5 text-gray-800 dark:text-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-center">

                <div class=" flex flex-col">
                    <h3 id="customer_name">
                        {{ $order->user->name }}
                    </h3>
                    <p class="text-sm opacity-70">
                        {{  '#'. $order->user->id_no }}
                    </p>
                    <p id="customer_mobile" class="flex items-center space-x-2">
                        <x-icon name="phone" class="w-4 h-4 inline-block" />
                        <span> {{ $order->user->mobile }}</span>
                    </p>
                    <p id="customer_mobile" class="flex items-center space-x-2">
                        <x-icon name="calendar" class="w-4 h-4 inline-block" />
                        <span> {{ $order->user->dob->format('d M, Y') }}</span>
                    </p>
                    <p class="flex items-center space-x-2" id="nationality">
                        <x-icon name="flag" class="w-4 h-4 inline-block" />
                        <span>
                            {{ $order->user->nationality }}
                       </span>
                    </p>
                </div>
                <div class="flex flex-col justify-center items-start">
                    <h2 class="text-xl font-bold" id="order_id">Order ID: {{ $order->order_number }}</h2>
                    <p class="text-gray-500" id="order_date">Order
                        Date: {{ $order->created_at->format('d M Y, h:i:s a') }}</p>
                    <p class="text-gray-500">Status: <span class="text-green-500">{{ $order->status }}</span></p>
                </div>

            </div>
            <div class="my-4">
                <h2 class="text-xl font-bold">Order Items</h2>
                <x-table-hover class="w-full mt-4">

                    <x-slot name="thead">
                        <th class="border px-4 py-2">Product</th>
                        <th class="border px-4 py-2">Quantity</th>
                        <th class="border px-4 py-2">Price</th>
                        <th class="border px-4 py-2">Total</th>
                    </x-slot>

                    <x-slot name="tbody">
                        @foreach ($order->products as $item)
                            <tr>
                                <td class="border px-4 py-2">
                                    <p id="order_items">{{ $item->name }}
                                        @if($item->instalment)
                                            <span class="text-sm text-red-500">-EMI</span>
                                        @endif
                                    </p>
                                </td>
                                <td class="border px-4 py-2">{{ $item->pivot->quantity }}</td>
                                <td class="border px-4 py-2">{{ $item->pivot->price }}</td>
                                <td class="border px-4 py-2">{{ $item->pivot->quantity * $item->pivot->price }}</td>
                            </tr>

                        @endforeach
                    </x-slot>

                </x-table-hover>
            </div>
            <div class="my-4">
                <h2 class="text-xl font-bold">Order Summary</h2>
                <x-table-hover class="w-full mt-4">
                    <x-slot name="thead">
                        <th class="border px-4 py-2">Subtotal</th>
                        <th class="border px-4 py-2">Shipping</th>
                        <th class="border px-4 py-2">Total</th>
                    </x-slot>
                    <x-slot name="tbody">
                        <td class="border px-4 py-2">{{ $order->subtotal }}</td>
                        <td class="border px-4 py-2">{{ $order->shipping }}</td>
                        <td class="border px-4 py-2" id="order_total">{{ $order->grand_total }}</td>
                    </x-slot>

                </x-table-hover>

            </div>
        </div>
    </div>
</section>
