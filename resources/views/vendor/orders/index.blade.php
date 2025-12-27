<x-app-layout>

    <h1 class="text-2xl font-semibold mb-6">
        Vendor Orders
    </h1>

    @if($orders->isEmpty())
        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-600">
                No orders assigned yet.
            </p>
        </div>
    @else
        <div class="bg-white rounded shadow overflow-x-auto">

            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-3">Order ID</th>
                        <th class="text-left p-3">Customer</th>
                        <th class="text-left p-3">Amount</th>
                        <th class="text-left p-3">Status</th>
                        <th class="text-left p-3">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-t">

                            <td class="p-3">
                                #{{ $order->id }}
                            </td>

                            <td class="p-3">
                                {{ $order->user->name ?? 'Customer' }}
                            </td>

                            <td class="p-3">
                                ₹{{ $order->total_amount ?? '—' }}
                            </td>

                            <td class="p-3">
                                @if($order->status === 'processing')
                                    <span class="px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-700">
                                        Processing
                                    </span>
                                @elseif($order->status === 'completed')
                                    <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                                        Completed
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-600">
                                        Pending
                                    </span>
                                @endif
                            </td>

                            <td class="p-3">
                                <form method="POST"
                                      action="{{ route('vendor.orders.updateStatus', $order->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <select name="status"
                                            class="border rounded px-2 py-1 text-sm">
                                        <option value="processing"
                                            {{ $order->status === 'processing' ? 'selected' : '' }}>
                                            Processing
                                        </option>
                                        <option value="completed"
                                            {{ $order->status === 'completed' ? 'selected' : '' }}>
                                            Completed
                                        </option>
                                    </select>

                                    <button type="submit"
                                            class="ml-2 px-3 py-1 bg-brand text-white rounded text-sm">
                                        Update
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @endif

</x-app-layout>
