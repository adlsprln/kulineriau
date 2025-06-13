<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KULINERIAU')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-blue-900 text-white shadow mb-8">
        <div class="max-w-screen-xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="text-2xl font-bold">KulineRiau</div>
            <div class="hidden md:flex space-x-8">
                <a href="/" class="hover:text-yellow-300 transition-colors">Home</a>
                <a href="/menu" class="hover:text-yellow-300 transition-colors">Menu</a>
                <a href="/tentangkami" class="hover:text-yellow-300 transition-colors">Tentang Kami</a>
                <a href="/order" class="hover:text-yellow-300 transition-colors">Order</a>
                <a href="/contact" class="hover:text-yellow-300 transition-colors">Kontak</a>
                <a href="/history" class="hover:text-yellow-300 transition-colors">History</a>
                <a href="/cart" class="hover:text-yellow-300 transition-colors font-bold">Keranjang</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/cart" class="relative group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-yellow-300 group-hover:text-white transition">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437m2.36 8.548l.882 3.527A2.25 2.25 0 0010.178 19.5h3.643a2.25 2.25 0 002.2-1.69l2.112-8.447a1.125 1.125 0 00-1.088-1.413H6.272m0 0L5.25 6.75m1.022 3.75h12.128" />
                    </svg>
                </a>
                @if(Auth::check())
                    <span class="mr-4">Halo, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-white text-blue-900 font-semibold px-6 py-2 rounded-full hover:bg-yellow-300 hover:text-blue-900 transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-blue-900 font-semibold px-6 py-2 rounded-full hover:bg-yellow-300 hover:text-blue-900 transition">Login</a>
                @endif
            </div>
        </div>
    </nav>
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>
</body>
</html>
