<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KulineRiau - Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .hero-bg {
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)),
                        url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 1200 800\"><rect fill=\"%230f2a60\" width=\"1200\" height=\"800\"/></svg>');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-50">
    @extends('layouts.app')
    @section('title', 'Menu')
    @section('content')
    <div class="bg-blue-900 py-20 min-h-screen">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <form method="GET" action="" class="flex justify-center">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu..." class="w-full max-w-md px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                    <button type="submit" class="ml-2 px-4 py-2 bg-yellow-300 text-blue-900 font-bold rounded-lg hover:bg-yellow-400 transition">Cari</button>
                </form>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @php
                    $filteredMenus = $menus;
                    if(request('search')) {
                        $filteredMenus = $menus->filter(function($menu) {
                            return stripos($menu->name, request('search')) !== false || stripos($menu->description, request('search')) !== false;
                        });
                    }
                @endphp
                @forelse($filteredMenus as $menu)
                <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center">
                    @php
                        $imagePath = $menu->image_url ? 'images/' . $menu->image_url : 'images/default.jpg';
                        $imageExists = $menu->image_url && file_exists(public_path($imagePath));
                    @endphp
                    @if(strtolower($menu->name) === 'gonggong')
                        <img src="/images/gonggong.jpeg" alt="Gonggong" class="w-32 h-32 object-cover rounded-full mb-4 border-4 border-blue-200">
                    @elseif($imageExists)
                        <img src="/{{ $imagePath }}" alt="{{ $menu->name }}" class="w-32 h-32 object-cover rounded-full mb-4 border-4 border-blue-200">
                    @else
                        <img src="/images/default.jpg" alt="Default" class="w-32 h-32 object-cover rounded-full mb-4 border-4 border-blue-200">
                    @endif
                    <h2 class="text-xl font-bold text-blue-900 mt-2">{{ $menu->name }}</h2>
                    <p class="text-gray-500 mt-1 mb-2">{{ $menu->description }}</p>
                    <p class="text-red-700 font-bold text-lg mb-2">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                    <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <button type="submit" class="bg-yellow-300 text-blue-900 font-bold px-4 py-2 rounded-lg w-full hover:bg-yellow-400 transition">Masukkan Keranjang</button>
                    </form>
                </div>
                @empty
                <div class="col-span-full text-white text-lg">Menu tidak ditemukan.</div>
                @endforelse
            </div>
        </div>
    </div>
    @endsection
</body>
</html>
