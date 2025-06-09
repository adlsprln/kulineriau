<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KulineRiau - Home</title>
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
    <!-- Header/Navigation -->
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
        <div class="max-w-4xl mx-auto">
            <div class="bg-white/10 backdrop-blur-sm rounded-full p-8 mb-8 inline-block">
                <div class="w-32 h-32 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                    <span class="text-4xl">🍛</span>
                </div>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang di KULINERIAU</h1>
            <p class="text-xl md:text-2xl opacity-90 mb-8">Temukan berbagai menu makanan dan minuman khas Riau yang lezat, pesan dengan mudah, dan nikmati pengalaman kuliner terbaik bersama kami!</p>
            <div class="flex gap-4 justify-center">
                <a href="/menu" class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-pink-500 hover:to-red-500 text-white px-6 py-2 rounded-lg shadow font-semibold transition-all duration-200">Lihat Menu</a>
                <a href="/order" class="bg-white border border-red-500 text-red-600 px-6 py-2 rounded-lg shadow hover:bg-red-50 font-semibold transition-all duration-200">Order Sekarang</a>
            </div>
        </div>
    </div>
    <footer class="bg-blue-900 text-white py-8">
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
