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
    <header class="hero-bg text-white relative">
        <nav class="max-w-screen-xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="text-2xl font-bold">KulineRiau</div>
            <div class="hidden md:flex space-x-8">
                <a href="/" class="hover:text-yellow-300 transition-colors">Home</a>
                <a href="/menu" class="hover:text-yellow-300 transition-colors">Menu</a>
                <a href="/tentangkami" class="hover:text-yellow-300 transition-colors">Tentang Kami</a>
                <a href="/order" class="hover:text-yellow-300 transition-colors">Order</a>
                <a href="/contact" class="hover:text-yellow-300 transition-colors">Kontak</a>
                <a href="/history" class="hover:text-yellow-300 transition-colors">History</a>
            </div>
            <div>
                <a href="/login" class="bg-white text-blue-900 font-semibold px-6 py-2 rounded-full hover:bg-yellow-300 hover:text-blue-900 transition">Login</a>
            </div>
        </nav>
    </header>
    <div class="container mx-auto px-6 py-20">
        <h1 class="text-4xl font-bold text-center text-red-700 mb-8">Daftar Menu</h1>
        <div class="overflow-x-auto w-full max-w-3xl mx-auto rounded-lg shadow-lg bg-white">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-red-600 to-pink-500 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-bold uppercase tracking-wider">Nama</th>
                        <th class="py-3 px-6 text-left text-xs font-bold uppercase tracking-wider">Deskripsi</th>
                        <th class="py-3 px-6 text-left text-xs font-bold uppercase tracking-wider">Harga</th>
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <th class="py-3 px-6 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($menus as $menu)
                    <tr class="hover:bg-gray-50 transition-all">
                        <td class="py-4 px-6 font-medium text-gray-900">{{ $menu->name }}</td>
                        <td class="py-4 px-6 text-gray-700">{{ $menu->description }}</td>
                        <td class="py-4 px-6 text-red-600 font-bold">Rp {{ number_format($menu->price,0,',','.') }}</td>
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <td class="py-4 px-6 text-center">
                            <a href="{{ route('menu.edit', $menu) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded mr-2 transition-all duration-150">Edit</a>
                            <form action="{{ route('menu.destroy', $menu) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded transition-all duration-150" onclick="return confirm('Yakin hapus menu?')">Hapus</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(Auth::check() && Auth::user()->isAdmin())
            <div class="text-center mt-8">
                <a href="{{ route('menu.create') }}" class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-pink-500 hover:to-red-500 text-white px-6 py-2 rounded-lg shadow font-semibold transition-all duration-200">+ Tambah Menu</a>
            </div>
        @endif
        @if(Auth::guest())
            <div class="mt-8 text-center">
                <a href="{{ route('login') }}" class="text-blue-600 underline">Login</a> atau
                <a href="{{ route('register') }}" class="text-blue-600 underline">Register</a> untuk akses lebih lanjut.
            </div>
        @endif
    </div>
    <footer class="bg-blue-900 text-white py-8 mt-16">
        <div class="container mx-auto px-6 text-center">
            <div class="mb-4">
                <h3 class="text-2xl font-bold mb-2">KulineRiau</h3>
                <p class="text-blue-200">Cita Rasa Asli Riau dalam Setiap Gigitan</p>
            </div>
            <div class="flex justify-center space-x-6 mb-4">
                <a href="#" class="text-blue-200 hover:text-white transition-colors">Instagram</a>
                <a href="#" class="text-blue-200 hover:text-white transition-colors">WhatsApp</a>
                <a href="#" class="text-blue-200 hover:text-white transition-colors">Facebook</a>
            </div>
            <p class="text-blue-300 text-sm">&copy; 2024 KulineRiau. Semua hak dilindungi.</p>
        </div>
    </footer>
</body>
</html>
