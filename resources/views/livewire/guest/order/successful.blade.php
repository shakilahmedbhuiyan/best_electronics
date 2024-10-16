<section>

    <div
        class="flex flex-col sm:flex-row justify-between items-center max-w-4xl mx-auto
        bg-emerald-50 dark:bg-gray-900 drop-shadow-lg dark:text-gray-300
        rounded-lg p-5 print:hidden">
        <div>
            <p class="text-2xl font-bold text-emerald-900 dark:text-emerald-600 font-serif">Thank you for shopping with
                <span class="capitalize"></span>{{ config('app.name') }}.</p>

            <ul class="text-sm italic list-disc px-2 ">
                <li class="list-item">
                    {!! "We will contact you on whatsapp for order verification." !!}
                </li>
                <li>
                    {!! "A نفاذ | NAFATH verification may required to verify identity." !!}
                </li>
            </ul>
        </div>

        <div>
            <span class="font-mono text-sm">
                <span>For any queries, contact us at:</span>
                <a href="tel:{{ $store['phone'] }}" class="text-emerald-700">
                            {{ $store['phone'] }}</a>
            </span>
        </div>
    </div>


    <div class="mt-8 mb-12 print:mt-3 print:mb-1 px-5 dark:text-gray-300">
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
                <p class="text-sm break-words" id="customer_address">
                    {{ $order->user->address }}
                    <span class="font-medium" id="customer_city">
                                {{ $order->user->city }}</span>
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

</section>
