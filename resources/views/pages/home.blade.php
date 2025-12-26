<x-app-layout>

    <!-- HERO SECTION -->
    <section class="bg-white rounded-lg p-10 shadow mb-10">
        <div class="grid md:grid-cols-2 gap-8 items-center">

            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    Medicines delivered safely to your home
                </h1>

                <p class="text-gray-600 mb-6">
                    Order genuine medicines, upload prescriptions securely,
                    and get fast delivery from verified vendors.
                </p>

                <div class="flex gap-4">
                    <a href="{{ route('products.index') }}"
                       class="bg-brand text-white px-6 py-3 rounded font-semibold">
                        Buy Medicines
                    </a>

                    @guest
                        <a href="{{ route('login') }}"
                           class="border px-6 py-3 rounded font-semibold">
                            Login
                        </a>
                    @endguest
                </div>
            </div>

            <div class="hidden md:block text-right">
                <img src="https://cdn-icons-png.flaticon.com/512/2966/2966481.png"
                     alt="Medical delivery"
                     class="inline w-64 opacity-90">
            </div>

        </div>
    </section>

    <!-- TRUST SECTION -->
    <section class="grid md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="font-semibold mb-2">✔ Verified Medicines</h3>
            <p class="text-sm text-gray-600">
                All medicines approved by admin before listing.
            </p>
        </div>

        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="font-semibold mb-2">🩺 Prescription Safety</h3>
            <p class="text-sm text-gray-600">
                Prescription medicines delivered only after verification.
            </p>
        </div>

        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="font-semibold mb-2">🚚 Fast Delivery</h3>
            <p class="text-sm text-gray-600">
                Orders processed directly by trusted vendors.
            </p>
        </div>

    </section>

    <!-- CTA SECTION -->
    <section class="bg-brand text-white rounded-lg p-8 text-center">
        <h2 class="text-2xl font-semibold mb-4">
            Start ordering your medicines today
        </h2>

        <a href="{{ route('products.index') }}"
           class="bg-white text-brand px-6 py-3 rounded font-semibold">
            View Medicines
        </a>
    </section>

</x-app-layout>
