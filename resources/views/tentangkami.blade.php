<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KulinerKepri - Tentang Kami</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .hero-bg {
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)),
                        url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-50">
    @extends('layouts.app')
    @section('title', 'Tentang Kami')
    @section('content')
    <div class="hero-bg min-h-[60vh] flex items-center justify-center">
        <div class="bg-white/70 rounded-xl shadow-lg p-8 max-w-3xl mx-auto mt-8">
            <h1 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6 text-center">Tentang KulinerKepri</h1>
            <p class="text-gray-800 text-lg mb-4 text-justify">
                Selamat datang di KulinerKepri, tempat terbaik untuk mengeksplorasi dan menikmati berbagai sajian kuliner khas Kepulauan Riau! Kami hadir untuk memperkenalkan kelezatan dan kekayaan rasa yang menjadi ciri khas dari daerah yang kaya akan budaya dan tradisi ini.
            </p>
            <p class="text-gray-800 text-lg text-justify">
                Kepulauan Riau, dengan pesona alamnya yang memukau, juga memiliki ragam kuliner yang tak kalah memikat. Dari cita rasa manis, pedas, hingga gurih, setiap hidangan yang kami sajikan menggambarkan kekayaan sejarah dan kebudayaan lokal yang telah turun-temurun dijaga. Kami berkomitmen untuk menyajikan hidangan dengan bahan-bahan pilihan dan resep otentik, yang diolah dengan penuh cinta dan keahlian.
            </p>
        </div>
    </div>
    <footer class="bg-blue-900 text-white py-8 mt-16">
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