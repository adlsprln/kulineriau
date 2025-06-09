<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KULINERIAU</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gradient-to-br from-red-50 to-pink-50 min-h-screen flex flex-col justify-center items-center">
    <div class="bg-white rounded-2xl shadow-xl p-10 w-full max-w-2xl border border-red-100 mt-10">
        <h1 class="text-5xl font-extrabold text-red-700 mb-6 text-center">KULINERIAU</h1>
        <p class="text-lg text-gray-700 text-center mb-8">Selamat datang di platform kuliner Riau! Temukan menu terbaik, pesan dengan mudah, dan nikmati pengalaman kuliner modern.</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('login') }}" class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 py-2 rounded-lg shadow font-semibold transition-all duration-200">Login</a>
            <a href="{{ route('register') }}" class="bg-white border border-red-500 text-red-600 px-6 py-2 rounded-lg shadow hover:bg-red-50 font-semibold transition-all duration-200">Register</a>
        </div>
    </div>
</body>
</html>
