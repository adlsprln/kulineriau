@extends('layouts.app')
@section('title', 'History')
@section('content')
<div class="flex flex-col items-center justify-center min-h-[60vh] bg-gradient-to-br from-red-50 to-pink-50">
    <div class="bg-white rounded-2xl shadow-xl p-10 w-full max-w-2xl border border-red-100">
        <h1 class="text-3xl font-extrabold text-red-700 mb-4 text-center">Riwayat Pesanan</h1>
        <p class="text-lg text-gray-700 max-w-xl text-center mb-6">Lihat riwayat pesanan Anda di sini. Semua transaksi tercatat dengan aman dan transparan.</p>
        <div class="text-center text-gray-400 py-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-red-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 4h6a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            <p>Belum ada riwayat pesanan.</p>
        </div>
    </div>
</div>
@endsection
