@extends('layouts.app')
@section('title', 'Riwayat Pemesanan')
@section('content')
<div class="container mx-auto px-6 py-20 text-center">
    <h1 class="text-4xl font-bold text-red-700 mb-8">Riwayat Pemesanan</h1>
    <p class="text-lg text-gray-700 max-w-xl mx-auto mb-6">Berikut adalah daftar pesanan Anda yang telah tercatat.</p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @php
            $orderHistory = session('order_history', []);
        @endphp
        @forelse($orderHistory as $order)
            @php
                $menu = \App\Models\Menu::find($order['menu_id']);
                $imagePath = $menu->image_url ? 'images/' . $menu->image_url : 'images/default.jpg';
                $imageExists = $menu->image_url && file_exists(public_path($imagePath));
            @endphp
            <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center">
                @if(strtolower($menu->name) === 'gonggong')
                    <img src="/images/gonggong.jpeg" alt="Gonggong" class="w-24 h-24 object-cover rounded-full mb-4 border-4 border-blue-200">
                @elseif($imageExists)
                    <img src="/{{ $imagePath }}" alt="{{ $menu->name }}" class="w-24 h-24 object-cover rounded-full mb-4 border-4 border-blue-200">
                @else
                    <img src="/images/default.jpg" alt="Default" class="w-24 h-24 object-cover rounded-full mb-4 border-4 border-blue-200">
                @endif
                <h2 class="text-xl font-bold text-blue-900 mt-2 mb-1">{{ $menu->name }}</h2>
                <p class="text-gray-500 mb-2">{{ $menu->description }}</p>
                <p class="text-red-700 font-bold text-lg mb-2">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                <div class="flex flex-col items-center w-full">
                    <div class="mb-2 w-full">
                        <span class="block text-sm text-gray-600">Jumlah:</span>
                        <span class="font-semibold text-blue-900">{{ $order['quantity'] ?? 1 }} pcs</span>
                    </div>
                    <div class="mb-2 w-full">
                        <span class="block text-sm text-gray-600">Metode Pembayaran:</span>
                        <span class="font-semibold text-blue-900">{{ $order['payment_method'] }}</span>
                    </div>
                    @if(!empty($order['buyer_request']))
                        <div class="mb-2 w-full">
                            <span class="block text-sm text-gray-600">Catatan:</span>
                            <span class="text-gray-800">{{ $order['buyer_request'] }}</span>
                        </div>
                    @endif
                    <div class="w-full mb-2">
                        <span class="block text-sm text-gray-600">Tanggal:</span>
                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($order['created_at'])->format('d M Y H:i') }}</span>
                    </div>
                    <div class="w-full mt-2">
                        <form action="{{ route('menu.rate', $menu->id) }}" method="POST" class="flex items-center gap-1 justify-center">
                            @csrf
                            <label class="mr-2 text-sm text-blue-900">Beri rating:</label>
                            @php
                                $currentRating = $menu->rating ?? 0;
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                <button type="submit" name="rating" value="{{ $i }}" class="focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $currentRating > 0 && $i <= $currentRating ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-500 transition" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.175c.969 0 1.371 1.24.588 1.81l-3.382 2.453a1 1 0 00-.364 1.118l1.286 3.967c.3.921-.755 1.688-1.54 1.118l-3.382-2.453a1 1 0 00-1.176 0l-3.382 2.453c-.784.57-1.838-.197-1.54-1.118l1.286-3.967a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.381-1.81.588-1.81h4.175a1 1 0 00.95-.69l1.286-3.967z" />
                                    </svg>
                                </button>
                            @endfor
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-gray-500 text-lg">Belum ada riwayat pemesanan.</div>
        @endforelse
    </div>
</div>
<footer class="bg-blue-900 text-white py-8 mt-16">
    <div class="container mx-auto px-6 text-center">
        <div class="mb-4">
            <h3 class="text-2xl font-bold mb-2">KulineRiau</h3>
            <p class="text-blue-200">Cita Rasa Asli Riau dalam Setiap Gigitan</p>
        </div>
        <div class="flex justify-center space-x-6 mb-4">
            <a href="#" class="text-blue-200 hover:text-white transition-colors">Instagram</a>
            <a href="#" class="text-blue-200 hover:text-white transition-colors">WhatsApp</a>
            <a href="#" class="text-blue-200 hover:text-white transition-colors">Facebook</a>
        </div>
        <p class="text-blue-300 text-sm">&copy; 2024 KulineRiau. Semua hak dilindungi.</p>
    </div>
</footer>
@endsection
