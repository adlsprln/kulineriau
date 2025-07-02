@extends('layouts.app')
@section('title', 'Upload Bukti Pembayaran')
@section('content')
<div class="max-w-lg mx-auto bg-white rounded-xl shadow-lg p-8 mt-10">
    <h1 class="text-2xl font-bold text-center text-blue-900 mb-6">Upload Bukti Pembayaran</h1>
    <form action="{{ route('order.upload_payment.post', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label class="block font-semibold mb-2">Kode Checkout:</label>
            <div class="bg-gray-100 rounded px-4 py-2">{{ $order->checkout_code ?? '-' }}</div>
        </div>
        <div>
            <label for="payment_proof" class="block font-semibold mb-2">Bukti Pembayaran (JPG, PNG, max 2MB)</label>
            <input type="file" name="payment_proof" id="payment_proof" accept="image/*" required class="block w-full border rounded px-4 py-2">
            @error('payment_proof')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex justify-between items-center mt-8">
            <a href="{{ route('history') }}" class="text-blue-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded font-bold shadow">Upload</button>
        </div>
    </form>
</div>
@endsection
