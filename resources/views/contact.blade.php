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
<body>
@extends('layouts.app')
@section('title', 'Kontak')
@section('content')
<div class="hero-bg min-h-screen flex flex-col">
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
</div>
@endsection
</body>
</html>
