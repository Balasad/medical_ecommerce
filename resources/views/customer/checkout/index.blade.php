<x-app-layout>

<h1 class="text-2xl font-semibold mb-6">Checkout</h1>

<form method="POST" action="{{ route('checkout.place') }}" enctype="multipart/form-data">
    @csrf

    <h3 class="font-semibold mb-2">Order Summary</h3>

    @foreach($cart as $item)
        <div class="border p-3 mb-2">
            {{ $item['name'] }} × {{ $item['qty'] }}
            <span class="float-right">₹{{ $item['price'] * $item['qty'] }}</span>

            @if($item['requires_prescription'])
                <div class="text-red-600 text-sm">Prescription required</div>
            @endif
        </div>
    @endforeach

    <div class="mt-4">
        <label class="block font-semibold">Upload Prescription (if required)</label>
        <input type="file" name="prescription">
    </div>

    <button class="mt-6 bg-brand text-white px-6 py-3 rounded">
        Place Order
    </button>

</form>

</x-app-layout>
