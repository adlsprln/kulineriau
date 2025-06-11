<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KulineRiau - Order</title>
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
    <div class="container mx-auto px-6 py-20 text-center">
        <h1 class="text-4xl font-bold text-red-700 mb-8">Order Menu</h1>
        <p class="text-lg text-gray-700 max-w-xl mx-auto mb-6">Silakan pilih menu yang ingin Anda pesan dan nikmati layanan terbaik dari kami.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($menus as $menu)
            <div class="bg-white rounded-lg shadow-lg p-6">
                @if(strtolower($menu->name) === 'gonggong')
                    <img src="/images/gonggong.jpeg" alt="Gonggong" class="w-full h-40 object-cover rounded-t-lg">
                @else
                    <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-40 object-cover rounded-t-lg">
                @endif
                <div class="mt-4">
                    <h2 class="text-xl font-bold text-gray-800">{{ $menu->name }}</h2>
                    <p class="text-gray-600 mt-2">{{ $menu->description }}</p>
                    <p class="text-red-700 font-bold mt-4">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                    <form action="{{ route('order.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <div class="mb-4">
                            <label for="payment_method" class="block text-left text-gray-700 font-bold mb-2">Metode Pembayaran:</label>
                            <select name="payment_method" id="payment_method" class="w-full border-gray-300 rounded-lg">
                                <option value="bank_transfer">Transfer Bank</option>
                                <option value="credit_card">Kartu Kredit</option>
                                <option value="e_wallet">E-Wallet</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="buyer_request" class="block text-left text-gray-700 font-bold mb-2">Permintaan Pembeli:</label>
                            <textarea name="buyer_request" id="buyer_request" rows="4" class="w-full border-gray-300 rounded-lg" placeholder="Contoh: Tanpa pedas, tambahan saus."></textarea>
                        </div>
                        <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition">Pesan</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
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
