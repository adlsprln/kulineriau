<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KulinerKepri - Menu</title>
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
            <div class="mb-6">
                <a href="{{ url()->previous() }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-blue-900 font-bold px-6 py-2 rounded-lg shadow transition">
                    ← Kembali
                </a>
            </div>
            @php
                $categories = [
                    'Sangat Populer' => 'Sangat Populer (Ikonik & Sering Dicari)',
                    'Cukup Populer' => 'Cukup Populer (Khas tapi Tidak Selalu Ada)',
                    'Jarang Dikenal Wisatawan' => 'Jarang Dikenal Wisatawan tapi Autentik',
                    'Minuman Khas Kepulauan Riau' => 'Minuman Khas Kepulauan Riau',
                ];

                $filteredMenus = $menus;
                if(request('search')) {
                    $filteredMenus = $menus->filter(function($menu) {
                        return stripos($menu->name, request('search')) !== false || stripos($menu->description, request('search')) !== false;
                    });
                }
            @endphp
            @foreach($categories as $catKey => $catLabel)
                <section class="mb-16">
                    <div class="flex items-center mb-8">
                        <div class="w-1 h-8 bg-yellow-400 rounded-r-lg mr-4"></div>
                        <h2 class="text-3xl font-extrabold text-white tracking-wide">{{ $catLabel }}</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                        @php
                            $groupMenus = $filteredMenus->where('category', $catKey);
                        @endphp
                        @forelse($groupMenus as $menu)
                            <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center hover:scale-105 transition-transform">
                                @php
                                    $imagePath = $menu->image_url ? '/images/' . $menu->image_url : '/images/default.jpg';
                                @endphp
                                <img src="{{ $imagePath }}" alt="{{ $menu->name }}" class="w-44 h-44 object-cover rounded-full mb-4 border-4 border-blue-200">
                                <h3 class="text-xl font-bold text-blue-900 mt-2 mb-1 text-center">{{ $menu->name }}</h3>
                                <p class="text-gray-500 mt-1 mb-2 text-center">{{ $menu->description }}</p>
                                <p class="text-red-700 font-bold text-lg mb-2">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                <form action="{{ route('cart.add', $menu->id) }}" method="POST" class="w-full">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <button type="submit" class="bg-yellow-300 text-blue-900 font-bold px-4 py-2 rounded-lg w-full hover:bg-yellow-400 transition">Masukkan Keranjang</button>
                                </form>
                            </div>
                        @empty
                            <div class="col-span-full text-white text-lg">Belum ada menu di kategori ini.</div>
                        @endforelse
                    </div>
                </section>
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
