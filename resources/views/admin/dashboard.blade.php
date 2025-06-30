@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<main class="container mx-auto px-6 py-10">
    <h2 class="text-3xl font-bold text-blue-800 text-center mb-10">Dashboard Admin</h2>

    <!-- Statistik Box -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
        <!-- Kelola Menu -->
        <div>
            <a href="{{ route('admin.menu.index') }}" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i data-lucide="utensils" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-blue-700">Kelola Menu</h3>
                        <p class="text-gray-500 text-sm">Lihat dan edit daftar menu makanan khas Kepri.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pesan User -->
        <div>
            <a href="{{ route('admin.contact.index') }}" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <div class="flex items-center space-x-4">
                    <div class="bg-green-100 p-3 rounded-full">
                        <i data-lucide="message-circle" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-green-700">Pesan User</h3>
                        <p class="text-gray-500 text-sm">Lihat pesan-pesan dari pengguna aplikasi.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Riwayat Order -->
        <div>
            <a href="{{ route('admin.order.index') }}" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <div class="flex items-center space-x-4">
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i data-lucide="clipboard-list" class="w-6 h-6 text-purple-600"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-purple-700">Riwayat Order</h3>
                        <p class="text-gray-500 text-sm">Lihat dan kelola status pembayaran pesanan.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</main>
@endsection

@section('scripts')
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>lucide.createIcons();</script>
@endsection
