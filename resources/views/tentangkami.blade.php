<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KulineRiau - Tentang Kami</title>
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
        <div class="bg-white rounded-2xl shadow-xl p-10 w-full max-w-3xl border border-red-100 mx-auto">
            <h1 class="text-4xl font-extrabold text-red-700 mb-4 text-center">Tentang Kami</h1>
            <p class="text-lg text-gray-700 max-w-2xl text-center mb-8 mx-auto">KULINERIAU adalah platform kuliner yang menghadirkan berbagai menu makanan dan minuman khas Riau. Kami berkomitmen memberikan pengalaman terbaik bagi pelanggan dengan layanan mudah, cepat, dan cita rasa otentik.</p>
            <div class="flex flex-col md:flex-row gap-8 mt-4">
                <div class="bg-gradient-to-br from-red-100 to-pink-100 rounded-lg shadow-lg p-6 w-full md:w-1/2">
                    <h2 class="text-xl font-semibold text-red-600 mb-2">Visi</h2>
                    <p class="text-gray-600">Menjadi platform kuliner terbaik di Riau yang menghubungkan pelanggan dengan cita rasa lokal.</p>
                </div>
                <div class="bg-gradient-to-br from-red-100 to-pink-100 rounded-lg shadow-lg p-6 w-full md:w-1/2">
                    <h2 class="text-xl font-semibold text-red-600 mb-2">Misi</h2>
                    <ul class="list-disc pl-5 text-gray-600 space-y-1">
                        <li>Menyediakan menu berkualitas dan bervariasi</li>
                        <li>Memberikan layanan pelanggan terbaik</li>
                        <li>Mendukung UMKM kuliner lokal</li>
                    </ul>
                </div>
            </div>
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
