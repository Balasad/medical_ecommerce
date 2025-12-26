<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-muted text-gray-800">
    <x-navbar />

    <main class="max-w-7xl mx-auto px-6 py-8">
        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        {{ $slot }}
    </main>
</body>
</html>
