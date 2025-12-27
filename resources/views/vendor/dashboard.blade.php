<x-app-layout>

    <h1 class="text-2xl font-semibold mb-6">Vendor Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Total Orders -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600">Total Orders</h3>
            <p class="text-3xl font-bold mt-2">
                {{ $totalOrders }}
            </p>
        </div>

        <!-- Processing Orders -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600">Processing</h3>
            <p class="text-3xl font-bold mt-2 text-yellow-600">
                {{ $processingOrders }}
            </p>
        </div>

        <!-- Completed Orders -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600">Completed</h3>
            <p class="text-3xl font-bold mt-2 text-green-600">
                {{ $completedOrders }}
            </p>
        </div>

    </div>

    <div class="mt-8">
        <a href="{{ route('vendor.orders.index') }}"
           class="inline-block bg-brand text-white px-6 py-3 rounded font-semibold">
            View Orders
        </a>
    </div>

</x-app-layout>
