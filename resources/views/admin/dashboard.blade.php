<x-app-layout>

    <h1 class="text-2xl font-semibold mb-6">
        Admin Dashboard
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Pending Products -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600">Pending Products</h3>
            <p class="text-3xl font-bold mt-2 text-yellow-600">
                {{ $pendingProducts }}
            </p>
            <a href="{{ route('admin.products.pending') }}"
               class="text-sm text-blue-600 mt-2 inline-block">
                Review Products →
            </a>
        </div>

        <!-- Pending Prescriptions -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600">Pending Prescriptions</h3>
            <p class="text-3xl font-bold mt-2 text-red-600">
                {{ $pendingPrescriptions }}
            </p>
            <a href="{{ route('admin.prescriptions.index') }}"
               class="text-sm text-blue-600 mt-2 inline-block">
                Review Prescriptions →
            </a>
        </div>

        <!-- Total Orders -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600">Total Orders</h3>
            <p class="text-3xl font-bold mt-2 text-green-600">
                {{ $totalOrders }}
            </p>
        </div>

    </div>

</x-app-layout>
