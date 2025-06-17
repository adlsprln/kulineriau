@extends('layouts.app')
@section('title', 'Struk Pesanan')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-10 print:mt-0">
    <h1 class="text-2xl font-bold text-center text-blue-900 mb-6">Struk Pesanan</h1>
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Kode Checkout:</span>
        <span>{{ $checkout_code }}</span>
    </div>
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Tanggal:</span>
        <span>{{ $orders->first()->created_at->format('d M Y') }}</span>
    </div>
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Nama Pemesan:</span>
        <span>{{ $orders->first()->user->name ?? '-' }}</span>
    </div>
    <table class="w-full mb-6 border">
        <thead>
            <tr class="bg-blue-100">
                <th class="py-2 px-4 border">Menu</th>
                <th class="py-2 px-4 border">Jumlah</th>
                <th class="py-2 px-4 border">Harga Satuan</th>
                <th class="py-2 px-4 border">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($orders as $order)
                @php $subtotal = $order->menu->price * $order->quantity; $total += $subtotal; @endphp
                <tr>
                    <td class="py-2 px-4 border">{{ $order->menu->name }}</td>
                    <td class="py-2 px-4 border text-center">{{ $order->quantity }}</td>
                    <td class="py-2 px-4 border text-right">Rp {{ number_format($order->menu->price, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="font-bold">
                <td colspan="3" class="py-2 px-4 border text-right">Total</td>
                <td class="py-2 px-4 border text-right">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Metode Pembayaran:</span>
        <span>{{ $orders->first()->payment_method }}</span>
    </div>
    @if($orders->first()->buyer_request)
    <div class="mb-4 flex justify-between">
        <span class="font-semibold">Catatan:</span>
        <span>{{ $orders->first()->buyer_request }}</span>
    </div>
    @endif
    <div class="text-center mt-8">
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-800 text-white px-6 py-2 rounded font-bold shadow print:hidden">Cetak Struk</button>
    </div>
</div>
@endsection
