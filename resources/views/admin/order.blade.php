@extends('layouts.app')
@section('title', 'Kelola Pesanan')
@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-blue-900 mb-8">Kelola Pesanan</h1>
    <div class="overflow-x-auto bg-white rounded-xl shadow p-6">
        <table class="min-w-full border border-blue-200">
            <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-2">Kode Checkout</th>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Menu</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-t border-blue-100">
                    <td class="px-4 py-2">{{ $order->checkout_code }}</td>
                    <td class="px-4 py-2">{{ $order->user->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $order->menu->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $order->quantity }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">{{ $order->status }}</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('admin.order.status.update', $order->checkout_code) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <select name="status" class="border rounded px-2 py-1">
                                <option value="Menunggu Pembayaran" {{ $order->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Dikirim" {{ $order->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Dibatalkan" {{ $order->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            <button type="submit" class="bg-blue-700 text-white px-3 py-1 rounded">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($orders->isEmpty())
            <div class="text-gray-500 text-center py-8">Belum ada pesanan.</div>
        @endif
    </div>
</div>
@endsection
