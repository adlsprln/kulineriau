<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KULINERIAU')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-white shadow mb-8">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="font-bold text-xl text-red-600">KULINERIAU</a>
            <ul class="flex space-x-6 items-center">
                <li><a href="/" class="hover:text-red-600">Home</a></li>
                <li><a href="/menu" class="hover:text-red-600">Menu</a></li>
                <li><a href="/order" class="hover:text-red-600"
                   @if(Auth::guest())
                      onclick="alert('Silakan login untuk melakukan order!'); return false;"
                   @endif
                >Order</a></li>
                <li><a href="/tentangkami" class="hover:text-red-600">Tentang Kami</a></li>
                <li><a href="/contact" class="hover:text-red-600">Contact</a></li>
                <li><a href="/history" class="hover:text-red-600">History</a></li>
                @if(Auth::check())
                    <li class="ml-4 text-gray-700">Halo, {{ Auth::user()->name }}</li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-red-600">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:text-red-600 font-semibold">Login</a></li>
                @endif
            </ul>
        </div>
    </nav>
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>
</body>
</html>
