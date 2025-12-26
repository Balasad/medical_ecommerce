<x-app-layout>
    <h1 class="text-2xl font-semibold mb-6">My Orders</h1>

    @if($orders->isEmpty())
        <p class="text-gray-600">You have not placed any orders yet.</p>
    @endif

    <div class="space-y-4">
        @foreach($orders as $order)
            <div class="bg-white p-4 rounded shadow flex justify-between items-center">

                <div>
                    <p class="font-semibold">Order #{{ $order->id }}</p>
                    <p class="text-sm text-gray-600">
                        Status:
                        <span class="font-medium capitalize">
                            {{ $order->status }}
                        </span>
                    </p>

                    @if($order->prescription_id)
                        <p class="text-xs text-red-600 mt-1">
                            Prescription Verified
                        </p>
                    @endif
                </div>

                <div class="text-right">
                    <p class="font-semibold">₹{{ $order->total_amount }}</p>
                    <p class="text-xs text-gray-500">
                        {{ $order->created_at->format('d M Y') }}
                    </p>
                </div>

            </div>
        @endforeach
    </div>
</x-app-layout>
