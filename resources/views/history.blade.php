@extends('layouts.app')
@section('title', 'History')
@section('content')
<div class="container mx-auto px-6 py-20 text-center">
    <h1 class="text-4xl font-bold text-red-700 mb-8">Riwayat Pemesanan</h1>
    <p class="text-lg text-gray-700 max-w-xl mx-auto mb-6">Berikut adalah daftar pesanan Anda yang telah tercatat.</p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if(session('order_history'))
            @php
                $menuNames = \App\Models\Menu::pluck('name', 'id')->toArray();
            @endphp
            @foreach(session('order_history') as $order)
            <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center">
                <h2 class="text-xl font-bold text-blue-900 mt-2">{{ $menuNames[$order['menu_id']] ?? 'Menu tidak ditemukan' }}</h2>
                <p class="text-gray-600 mt-2">Metode Pembayaran: {{ $order['payment_method'] }}</p>
                <p class="text-gray-600 mt-2">Permintaan Pembeli: {{ $order['buyer_request'] ?? 'Tidak ada' }}</p>
                <p class="text-red-700 font-bold mt-4">Tanggal: {{ $order['created_at'] }}</p>
            </div>
            @endforeach
        @else
            <p class="text-gray-500">Belum ada riwayat pesanan.</p>
        @endif
    </div>
</div>
@endsection
