<x-app-layout>

    <h1 class="text-2xl font-semibold mb-6">
        Pending Products Approval
    </h1>

    @if($products->isEmpty())
        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-600">No pending products 🎉</p>
        </div>
    @else
        <div class="bg-white rounded shadow overflow-x-auto">

            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Vendor</th>
                        <th class="p-3 text-left">Price</th>
                        <th class="p-3 text-left">Prescription</th>
                        <th class="p-3 text-left">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                        <tr id="product-row-{{ $product->id }}" class="border-t">

                            <td class="p-3 font-medium">
                                {{ $product->name }}
                            </td>

                            <td class="p-3">
                                {{ $product->vendor->pharmacy_name ?? '—' }}
                            </td>

                            <td class="p-3">
                                ₹{{ $product->price }}
                            </td>

                            <td class="p-3">
                                @if($product->requires_prescription)
                                    <span class="text-red-600 font-semibold">Yes</span>
                                @else
                                    <span class="text-green-600">No</span>
                                @endif
                            </td>

                            <td class="p-3 space-x-2">
                                <button
                                    onclick="approveProduct({{ $product->id }})"
                                    class="px-4 py-1 bg-green-600 text-white rounded text-xs">
                                    Approve
                                </button>

                                <button
                                    onclick="rejectProduct({{ $product->id }})"
                                    class="px-4 py-1 bg-red-600 text-white rounded text-xs">
                                    Reject
                                </button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @endif

</x-app-layout>

<script>
    function approveProduct(productId) {
        fetch(`/admin/products/${productId}/process`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(() => {
            document.getElementById(`product-row-${productId}`).remove();
        });
    }

    function rejectProduct(productId) {
        fetch(`/admin/products/${productId}/reject`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(() => {
            document.getElementById(`product-row-${productId}`).remove();
        });
    }
</script>
