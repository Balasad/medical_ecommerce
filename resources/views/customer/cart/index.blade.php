<x-app-layout>

    <h1 class="text-2xl font-semibold mb-6">Your Cart</h1>

    @if(empty($cart))
        <p>Your cart is empty.</p>
    @else
        <table class="w-full border">
            <thead>
                <tr class="border-b">
                    <th class="p-2">Medicine</th>
                    <th class="p-2">Qty</th>
                    <th class="p-2">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr class="border-b">
                        <td class="p-2">
                            {{ $item['name'] }}
                            @if($item['requires_prescription'])
                                <div class="text-red-600 text-sm">
                                    Prescription required
                                </div>
                            @endif
                        </td>
                        <td class="p-2">{{ $item['qty'] }}</td>
                        <td class="p-2">₹{{ $item['price'] * $item['qty'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    <a href="{{ route('checkout.show') }}"
   class="bg-brand text-white px-6 py-3 rounded">
   Proceed to Checkout
</a>

    @endif

</x-app-layout>
