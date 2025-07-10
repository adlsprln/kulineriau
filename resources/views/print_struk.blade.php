@extends('layouts.app')
@section('title', 'Struk Pesanan')
@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-10 print:p-0 print:shadow-none">
    <h1 class="text-2xl font-bold text-center text-blue-900 mb-6">Struk Pesanan</h1>
    <div class="mb-4 flex justify-between">
        <div><b>Kode Checkout:</b> {{ $checkout_code }}</div>
        <div><b>Tanggal:</b> {{ $firstOrder->created_at->format('d M Y H:i') }}</div>
    </div>
    <div class="mb-4"><b>Pemesan:</b> {{ $firstOrder->user->name ?? '-' }}</div>
    <div class="mb-4">
        <b>Alamat Pengiriman:</b><br>
        {{ $firstOrder->user->address ?? '-' }}<br>
        {{ $firstOrder->user->city ?? '' }}{{ $firstOrder->user->postal_code ? ', ' . $firstOrder->user->postal_code : '' }}
    </div>
    <table class="min-w-full border border-blue-200 rounded-xl mb-6">
        <thead class="bg-blue-100">
            <tr>
                <th class="px-4 py-2 text-left">Menu</th>
                <th class="px-4 py-2 text-left">Harga</th>
                <th class="px-4 py-2 text-left">Jumlah</th>
                <th class="px-4 py-2 text-left">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($orders as $order)
                @php $menu = $order->menu; $subtotal = $menu->price * $order->quantity; $total += $subtotal; @endphp
                <tr class="border-t border-blue-100">
                    <td class="px-4 py-2">{{ $menu->name }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">{{ $order->quantity }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="font-bold">
                <td colspan="3" class="px-4 py-2 text-right">Total</td>
                <td class="px-4 py-2">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    <div class="mb-4"><b>Metode Pembayaran:</b> {{ $firstOrder->payment_method }}</div>
    <div class="mb-4"><b>Status:</b> {{ $firstOrder->status }}</div>
    <div class="text-center mt-8">
        <button onclick="window.print()" class="bg-blue-700 hover:bg-blue-900 text-white px-6 py-2 rounded font-bold shadow print:hidden">Print</button>
    </div>
</div>
@endsection
