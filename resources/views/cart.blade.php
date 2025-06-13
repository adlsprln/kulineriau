@extends('layouts.app')
@section('title', 'Keranjang Belanja')
@section('content')
<div class="container mx-auto px-6 py-20 text-center">
    <h1 class="text-4xl font-bold text-red-700 mb-8">Keranjang Belanja</h1>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">{{ session('error') }}</div>
    @endif
    @if(count($cart) > 0)
        <form action="{{ route('cart.checkout') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($menus as $menu)
                    <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center">
                        <input type="checkbox" name="selected_menus[]" value="{{ $menu->id }}" id="menu_{{ $menu->id }}" class="mb-2 w-5 h-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="menu_{{ $menu->id }}" class="sr-only">Pilih {{ $menu->name }}</label>
                        <img src="/images/{{ $menu->image_url ?? 'default.jpg' }}" alt="{{ $menu->name }}" class="w-24 h-24 object-cover rounded-full mb-4 border-4 border-blue-200">
                        <h2 class="text-xl font-bold text-blue-900 mt-2 mb-1">{{ $menu->name }}</h2>
                        <p class="text-gray-500 mb-2">{{ $menu->description }}</p>
                        <p class="text-red-700 font-bold text-lg mb-2">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                        <div class="mb-2 w-full flex flex-col items-center">
                            <span class="block text-sm text-gray-600">Jumlah:</span>
                            <input type="number" name="quantities[{{ $menu->id }}]" value="{{ $cart[$menu->id] }}" min="1" class="w-20 text-center border border-gray-300 rounded px-2 py-1 font-semibold text-blue-900" />
                        </div>
                        <form action="{{ route('cart.remove', $menu->id) }}" method="POST" class="w-full mt-2">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded w-full hover:bg-red-700 transition">Hapus</button>
                        </form>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 max-w-lg mx-auto bg-white rounded-xl shadow p-6">
                <h3 class="text-xl font-bold mb-4 text-blue-900">Checkout</h3>
                <div class="mb-4">
                    <label for="payment_method" class="block text-left text-gray-700 font-bold mb-2">Metode Pembayaran:</label>
                    <select name="payment_method" id="payment_method" class="w-full border-gray-300 rounded-lg">
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="credit_card">Kartu Kredit</option>
                        <option value="e_wallet">E-Wallet</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="buyer_request" class="block text-left text-gray-700 font-bold mb-2">Permintaan Pembeli:</label>
                    <textarea name="buyer_request" id="buyer_request" rows="3" class="w-full border-gray-300 rounded-lg" placeholder="Contoh: Tanpa pedas, tambahan saus."></textarea>
                </div>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg w-full hover:bg-green-700 transition">Checkout</button>
            </div>
        </form>
    @else
        <div class="text-gray-500 text-lg">Keranjang Anda kosong.</div>
    @endif
</div>
@endsection
