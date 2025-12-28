<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Pending Products Approval</h1>

    @if($products->isEmpty())
        <div class="bg-white p-6 rounded shadow">
            No pending products 🎉
        </div>
    @else
        @foreach($products as $product)
            <div class="border p-4 mb-4 rounded bg-white">
                <h2 class="font-semibold">{{ $product->name }}</h2>
                <p>SKU: {{ $product->sku }}</p>
                <p>Price: ₹{{ $product->price }}</p>
                <p>Vendor ID: {{ $product->vendor_id }}</p>

                <div class="mt-3 flex gap-2">
                    <form method="POST"
                          action="{{ route('admin.products.process', $product->id) }}">
                        @csrf
                        <button class="bg-green-600 text-black px-4 py-1 rounded">
                            Approve
                        </button>
                    </form>

                    <form method="POST"
                          action="{{ route('admin.products.reject', $product->id) }}">
                        @csrf
                        <button class="bg-red-600 text-black px-4 py-1 rounded">
                            Reject
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</x-app-layout>
