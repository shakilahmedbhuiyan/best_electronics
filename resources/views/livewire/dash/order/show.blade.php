<section>
    <x-slot name="button">
        <a href="{{ route('admin.order.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back</a>
    </x-slot>

    <div class="my-4 w-full">

        <div class="my-4">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold">Order ID: {{ $order->order_number }}</h2>
                    <p class="text-gray-500">Order Date: {{ $order->created_at->format('d M Y, h:i:s a') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Status: <span class="text-green-500">{{ $order->status }}</span></p>
                </div>
            </div>
            <div class="my-4">
                <h2> Customer:</h2>
                <x-table-hover class="w-full mt-4">
                    <x-slot name="thead">
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">mobile</th>
                        <th class="border px-4 py-2">Address</th>
                        <th class="border px-4 py-2">Nationality</th>
                    </x-slot>
                    <x-slot name="tbody">
                        <td class="border px-4 py-2">
                            <p>{{ $order->user->name }}</p>
                            <span class="text-sm opacity-70">
                                {{  '#'. $order->user->id_no }}
                            </span>
                        </td>
                        <td class="border px-4 py-2">{{ $order->user->email }}</td>
                        <td class="border px-4 py-2">{{ $order->user->mobile }}</td>
                        <td class="border px-4 py-2">
                            <p class="text-sm text-justify break-words">
                                {{ $order->user->address }}</p>
                            <span class="font-medium">{{ $order->user->city }}</span>
                        </td>
                        <td class="border px-4 py-2">{{ $order->user->nationality }}</td>
                    </x-slot>
                </x-table-hover>
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
                                    <p>{{ $item->name }}
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
                        <td class="border px-4 py-2">{{ $order->grand_total }}</td>
                    </x-slot>

                </x-table-hover>
                <div>
                    <h3>Shipping Address:</h3>
                    <p>{{ $order->shipping_address }}</p>

                </div>
            </div>
        </div>
    </div>
</section>
