<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">My Cart</h1>

    @if(empty($cart))
        <p>Your cart is empty.</p>
    @else
        @foreach($cart as $item)
            <div class="border p-3 mb-2">
                {{ $item['name'] }} —
                ₹{{ $item['price'] }} × {{ $item['quantity'] }}
            </div>
        @endforeach

        <a href="{{ route('checkout.show') }}"
           class="inline-block mt-4 bg-blue-600 text-black px-4 py-2 rounded">
            Proceed to Checkout
        </a>
    @endif
</x-app-layout>
