@extends('layouts.app')
@section('title', 'Struk Pesanan')
@section('content')
<div class="max-w-lg mx-auto bg-white rounded-xl shadow-lg p-8 mt-10 print:mt-0">
    <h1 class="text-2xl font-bold text-center text-blue-900 mb-6">Struk Pesanan</h1>
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">No. Pesanan:</span>
        <span>#{{ $order->id }}</span>
    </div>
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Tanggal:</span>
        <span>{{ $order->created_at->format('d M Y') }}</span>
    </div>
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Nama Pemesan:</span>
        <span>{{ $order->user->name ?? '-' }}</span>
    </div>
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Menu:</span>
        <span>{{ $order->menu->name }}</span>
    </div>
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Jumlah:</span>
        <span>{{ $order->quantity }} pcs</span>
    </div>
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Harga Satuan:</span>
        <span>Rp {{ number_format($order->menu->price, 0, ',', '.') }}</span>
    </div>
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Total:</span>
        <span>Rp {{ number_format($order->menu->price * $order->quantity, 0, ',', '.') }}</span>
    </div>
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Metode Pembayaran:</span>
        <span>{{ $order->payment_method }}</span>
    </div>
    @if($order->buyer_request)
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Catatan:</span>
        <span>{{ $order->buyer_request }}</span>
    </div>
    @endif
    <div class="text-center mt-8">
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-800 text-white px-6 py-2 rounded font-bold shadow print:hidden">Cetak Struk</button>
    </div>
</div>
@endsection
