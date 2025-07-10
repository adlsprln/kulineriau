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
            @if(Auth::check() && Auth::user()->isAdmin())
                @php
                    $contacts = App\Models\Contact::with('user')->latest()->get();
                @endphp
                @if($contacts->count())
                    <div class="bg-white/80 rounded-xl shadow p-6 mt-8">
                        <h2 class="text-xl font-bold text-blue-900 mb-4 text-center">User yang Memberi Saran/Kritik</h2>
                        <ul class="divide-y divide-gray-200">
                            @foreach($contacts as $contact)
                                <li class="py-2 flex flex-col md:flex-row md:items-center md:justify-between">
                                    <span class="font-semibold text-blue-900">{{ $contact->user ? $contact->user->name : $contact->name }}</span>
                                    <span class="text-gray-600 text-sm italic">"{{ $contact->message }}"</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="bg-white/80 rounded-xl shadow p-6 mt-8 text-center text-gray-500">Belum ada saran/kritik dari user.</div>
                @endif
            @else
                <form action="{{ route('contact.store') }}" method="POST" class="mb-8">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Nama</label>
                        <input type="text" name="name" class="border border-red-200 rounded px-3 py-2 w-full focus:ring-2 focus:ring-red-300" placeholder="Nama Anda" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email" class="border border-red-200 rounded px-3 py-2 w-full focus:ring-2 focus:ring-red-300" placeholder="Email Anda">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Pesan</label>
                        <textarea name="message" class="border border-red-200 rounded px-3 py-2 w-full focus:ring-2 focus:ring-red-300" rows="4" placeholder="Tulis pesan Anda..." required></textarea>
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 py-2 rounded-lg shadow font-semibold w-full">Kirim Pesan</button>
                </form>
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-2 rounded mb-4 text-center">{{ session('success') }}</div>
                @endif
            @endif
            <div class="mt-6 text-center text-gray-500">
                <p>Email: info@kulineriau.com</p>
                <p>Telepon: 0812-3456-7890</p>
            </div>
        </div>
</div><footer class="bg-blue-900 text-white py-8 mt-16">
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
@endsection
</body>
</html>
