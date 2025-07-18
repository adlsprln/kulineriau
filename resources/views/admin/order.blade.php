@extends('layouts.app')
@section('title', 'Kelola Pesanan')
@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-blue-900 font-bold px-6 py-2 rounded-lg shadow transition">
            ← Kembali ke Dashboard
        </a>
    </div>
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
                    <th class="px-4 py-2">Tanggal Order</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Bukti Pembayaran</th> <!-- Tambah kolom -->
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            @php
                $groupedOrders = $orders->groupBy('checkout_code');
            @endphp
            <tbody>
            @forelse($groupedOrders as $checkout_code => $group)
                @php $firstOrder = $group->first(); @endphp
                <tr class="border-t border-blue-100 bg-blue-50">
                    <td class="px-4 py-2 align-middle text-center" rowspan="{{ $group->count() }}">{{ $checkout_code }}</td>
                    <td class="px-4 py-2 align-middle text-center" rowspan="{{ $group->count() }}">{{ $firstOrder->user->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $firstOrder->menu->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $firstOrder->quantity }}</td>
                    <td class="px-4 py-2 text-red-700 font-bold">Rp {{ number_format($firstOrder->menu->price ?? 0, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 align-middle text-center" rowspan="{{ $group->count() }}">
                        <span class="text-blue-800">{{ $firstOrder->created_at ? $firstOrder->created_at->format('d M Y H:i') : '-' }}</span>
                    </td>
                    <td class="px-4 py-2 align-middle text-center" rowspan="{{ $group->count() }}">{{ $firstOrder->status }}</td>
                    <td class="px-4 py-2 align-middle text-center" rowspan="{{ $group->count() }}">
                        @if($firstOrder->payment_proof)
                            <a href="{{ asset('storage/payment_proofs/' . $firstOrder->payment_proof) }}" target="_blank">
                                <img src="{{ asset('storage/payment_proofs/' . $firstOrder->payment_proof) }}" alt="Bukti Pembayaran" style="width:70px; height:70px; object-fit:cover; border-radius:8px; border:1px solid #cbd5e1;">
                            </a>
                        @else
                            <span class="text-gray-400 text-xs">Belum ada</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 align-middle text-center" rowspan="{{ $group->count() }}">
                        <form action="{{ route('admin.order.status.update', $checkout_code) }}" method="POST" class="flex items-center gap-2 justify-center">
                            @csrf
                            <select name="status" class="border rounded px-2 py-1">
                                <option value="Diproses" {{ $firstOrder->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Dikirim" {{ $firstOrder->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="Selesai" {{ $firstOrder->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Dibatalkan" {{ $firstOrder->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            <button type="submit" class="bg-blue-700 text-white px-3 py-1 rounded">Update</button>
                        </form>
                    </td>
                </tr>
                @foreach($group->skip(1) as $order)
                <tr class="border-t border-blue-100 bg-blue-50">
                    <td class="px-4 py-2">{{ $order->menu->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $order->quantity }}</td>
                    <td class="px-4 py-2 text-red-700 font-bold">Rp {{ number_format($order->menu->price ?? 0, 0, ',', '.') }}</td>
                    <td></td> <!-- Tanggal Order -->
                    <td></td> <!-- Status -->
                    <td></td> <!-- Bukti Pembayaran -->
                    <td></td> <!-- Aksi -->
                </tr>
                @endforeach
            @empty
                <tr><td colspan="9" class="text-gray-500 text-center py-8">Belum ada pesanan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
