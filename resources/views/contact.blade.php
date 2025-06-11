<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KulineRiau - Kontak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .hero-bg {
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)),
                url('/images/kontak.jpeg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="hero-bg min-h-screen flex flex-col">
    <!-- Header/Navigation -->
    <header>
        <nav class="bg-[#0a1c40] text-white max-w-full px-8 py-4 flex items-center justify-between rounded-b-2xl shadow-lg">
            <div class="text-2xl font-bold">KulineRiau</div>
            <div class="hidden md:flex space-x-10 font-semibold">
                <a href="/" class="hover:text-yellow-300 transition-colors">Home</a>
                <a href="/menu" class="hover:text-yellow-300 transition-colors">Menu</a>
                <a href="/tentangkami" class="hover:text-yellow-300 transition-colors">Tentang Kami</a>
                <a href="/order" class="hover:text-yellow-300 transition-colors">Order</a>
                <a href="/contact" class="hover:text-yellow-300 transition-colors">Kontak</a>
                <a href="/history" class="hover:text-yellow-300 transition-colors">History</a>
            </div>
            <div>
                <a href="/login" class="bg-white text-[#0a1c40] font-semibold px-6 py-2 rounded-full hover:bg-yellow-300 hover:text-[#0a1c40] transition">Login</a>
            </div>
        </nav>
    </header>
    <div class="flex-1 flex items-center justify-center py-20">
        <div class="bg-white/80 rounded-2xl shadow-xl p-10 w-full max-w-lg border border-red-100 mx-auto">
            <h1 class="text-4xl font-extrabold text-blue-900 mb-4 text-center">Hubungi Kami</h1>
            <p class="text-lg text-gray-700 max-w-xl text-center mb-6">Ada pertanyaan, kritik, atau saran? Silakan hubungi kami melalui form di bawah ini atau kontak resmi kami.</p>
            <form>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Nama</label>
                    <input type="text" class="border border-red-200 rounded px-3 py-2 w-full focus:ring-2 focus:ring-red-300" placeholder="Nama Anda">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" class="border border-red-200 rounded px-3 py-2 w-full focus:ring-2 focus:ring-red-300" placeholder="Email Anda">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Pesan</label>
                    <textarea class="border border-red-200 rounded px-3 py-2 w-full focus:ring-2 focus:ring-red-300" rows="4" placeholder="Tulis pesan Anda..."></textarea>
                </div>
                <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 py-2 rounded-lg shadow font-semibold w-full">Kirim Pesan</button>
            </form>
            <div class="mt-6 text-center text-gray-500">
                <p>Email: info@kulineriau.com</p>
                <p>Telepon: 0812-3456-7890</p>
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
