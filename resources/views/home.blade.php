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
            background: #0a1c40;
        }
        .welcome-bg {
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)),
                url('/images/anambas.jpg');
            background-size: cover;
            background-position: center;
        } 
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
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

    <!-- Hero Section -->
    <div class="welcome-bg">
        <div class="container mx-auto px-6 py-16 flex flex-col justify-center items-center min-h-[40vh] text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 bg-gradient-to-br from-white via-gray-200 to-gray-400 bg-clip-text text-transparent drop-shadow-lg">Selamat Datang di KulineRiau</h1>
                <p class="text-xl md:text-2xl opacity-90 mb-8 text-white drop-shadow">Temukan berbagai menu makanan dan minuman khas Riau yang lezat, pesan dengan mudah, dan nikmati pengalaman kuliner terbaik bersama kami!</p>
                <div class="flex gap-4 justify-center mb-12">
                    <a href="/menu" class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-pink-500 hover:to-red-500 text-white px-6 py-2 rounded-lg shadow font-semibold transition-all duration-200">Lihat Menu</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Andalan Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-10 text-gray-800">Menu Andalan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Menu 1 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <img src="/images/rendang.jpg" alt="Rendang Riau" class="rounded-t-lg w-full h-56 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2">Rendang Riau</h3>
                        <p class="text-gray-600">Cita rasa rendang khas Riau yang gurih, kaya rempah, dan bikin nagih.</p>
                    </div>
                </div>
                <!-- Menu 2 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <img src="/images/laksamana.jpg" alt="Laksamana Mengamuk" class="rounded-t-lg w-full h-56 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2">Laksamana Mengamuk</h3>
                        <p class="text-gray-600">Minuman tradisional segar berbahan dasar mangga kuini dan santan.</p>
                    </div>
                </div>
                <!-- Menu 3 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <img src="/images/roti-jala.jpg" alt="Roti Jala" class="rounded-t-lg w-full h-56 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2">Roti Jala</h3>
                        <p class="text-gray-600">Roti lembut yang disajikan dengan kari ayam khas Melayu Riau.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
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
