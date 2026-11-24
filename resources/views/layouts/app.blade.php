<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <header class="border-b border-gray-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">
                {{ config('app.name') }}
            </a>
            <nav class="text-sm font-medium text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-10">
        @yield('content')
    </main>

    <footer class="mt-10 border-t border-gray-200 bg-white">
        <div class="mx-auto max-w-6xl px-4 py-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </footer>

</body>

</html>
