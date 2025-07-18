<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KulinerKepri - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .hero-bg {
            background: #0a1c40;
        }
        .welcome-bg {
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)),
                url('/images/home.jpeg');
            background-size: cover;
            background-position: center;
        } 
    </style>
</head>
<body class="bg-gray-50">
@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <!-- Hero Section -->
    <div class="welcome-bg">
        <div class="container mx-auto px-6 py-16 flex flex-col justify-center items-center min-h-[40vh] text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 bg-gradient-to-br from-white via-gray-200 to-gray-400 bg-clip-text text-transparent drop-shadow-lg">Selamat Datang di KulinerKepri</h1>
                <p class="text-xl md:text-2xl opacity-90 mb-8 text-white drop-shadow">Temukan berbagai menu makanan dan minuman khas Kepulauan Riau yang lezat, pesan dengan mudah, dan nikmati pengalaman kuliner terbaik bersama kami!</p>
                <div class="flex gap-4 justify-center mb-12">
                    <a href="/menu" class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-pink-500 hover:to-red-500 text-white px-6 py-2 rounded-lg shadow font-semibold transition-all duration-200">Lihat Menu</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Andalan Section: Menu Terfavorit -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-10 text-gray-800">Menu Best Seller</h2>
            <!-- Gambar menu populer -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $favoriteMenus = \App\Models\Menu::orderByDesc('rating')->take(3)->get();
                @endphp
                @foreach($favoriteMenus as $menu)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col h-full">
                    @php
                        $imagePath = $menu->image_url ? 'images/' . $menu->image_url : 'images/default.jpg';
                    @endphp
                    @if($menu->image_url)
                        <img src="/{{ $imagePath }}" alt="{{ $menu->name }}" class="rounded-t-lg w-full h-56 object-cover">
                    @else
                        <img src="/images/default.jpg" alt="Default" class="rounded-t-lg w-full h-56 object-cover">
                    @endif
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-xl font-semibold mb-2">{{ $menu->name }}</h3>
                        <p class="text-gray-600 mb-2 italic min-h-[40px]">
                            {{ $menu->description ? $menu->description : 'Belum ada deskripsi menu.' }}
                        </p>
                        <p class="text-red-700 font-bold text-lg mb-2">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                        <div class="flex items-center mt-1 mb-4">
                            @for($i = 0; $i < 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $i < ($menu->rating ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.175c.969 0 1.371 1.24.588 1.81l-3.382 2.453a1 1 0 00-.364 1.118l1.286 3.967c.3.921-.755 1.688-1.54 1.118l-3.382-2.453a1 1 0 00-1.176 0l-3.382 2.453c-.784.57-1.838-.197-1.54-1.118l1.286-3.967a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.381-1.81.588-1.81h4.175a1 1 0 00.95-.69l1.286-3.967z" />
                                </svg>
                            @endfor
                            <span class="ml-2 text-sm text-gray-500">({{ $menu->rating ?? 0 }})</span>
                        </div>
                        <form action="{{ route('cart.add', $menu->id) }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            <button type="submit" class="bg-yellow-300 text-blue-900 font-bold px-4 py-2 rounded-lg w-full hover:bg-yellow-400 transition">Masukkan Keranjang</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div><footer class="bg-blue-900 text-white py-8 mt-16">
    <div class="container mx-auto px-6 text-center">
        <div class="mb-4">
            <h3 class="text-2xl font-bold mb-2">KulinerKepri</h3>
            <p class="text-blue-200">Cita Rasa Asli Kepulauan Riau dalam Setiap Gigitan</p>
        </div>
        <div class="flex justify-center space-x-6 mb-4">
            <a href="#" class="text-blue-200 hover:text-white transition-colors">Instagram</a>
            <a href="#" class="text-blue-200 hover:text-white transition-colors">WhatsApp</a>
            <a href="#" class="text-blue-200 hover:text-white transition-colors">Facebook</a>
        </div>
        <p class="text-blue-300 text-sm">&copy; 2024 KulinerKepri. Semua hak dilindungi.</p>
    </div>
</footer>
@endsection

                
</body>
</html>
