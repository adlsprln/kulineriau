@extends('layouts.app')
@section('title', 'Riwayat Pemesanan')
@section('content')
@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Order;
    use App\Models\Menu;
    use App\Models\User;
    if(Auth::check() && Auth::user()->isAdmin()) {
        $orders = Order::with(['menu', 'user'])->latest()->get();
    } else {
        $orders = Auth::check() ? Order::where('user_id', Auth::id())->latest()->get() : collect();
    }
@endphp
<div class="container mx-auto px-6 py-20 text-center">
    <h1 class="text-4xl font-bold text-red-700 mb-8">Riwayat Pemesanan</h1>
    <p class="text-lg text-gray-700 max-w-xl mx-auto mb-6">Berikut adalah daftar pesanan Anda yang telah tercatat.</p>
    @if(session('success'))
        <div class="mb-6 px-4 py-3 rounded bg-green-100 text-green-800 font-semibold border border-green-300">
            {{ session('success') }}
        </div>
    @endif
    @if(Auth::check() && Auth::user()->isAdmin())
        @php
            $groupedOrders = $orders->groupBy('checkout_code');
        @endphp
        <div class="flex flex-col gap-6">
            @php $i = 0; @endphp
            @forelse($groupedOrders as $checkout_code => $group)
                @php
                    $firstOrder = $group->first();
                    $user = isset($firstOrder->user) ? $firstOrder->user : null;
                @endphp
                <div class="w-full mb-6">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 text-left border-2 border-blue-200 overflow-x-auto w-full">
                        <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <span class="font-bold text-blue-900">Pemesan:</span>
                                <span class="text-blue-800">{{ $user ? $user->name : '-' }}</span>
                            </div>
                            <div>
                                <span class="font-bold text-blue-900">Waktu Checkout:</span>
                                <span class="text-blue-800">{{ $firstOrder->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="font-bold text-blue-900">Kode Checkout:</span>
                                <span class="text-blue-800">{{ $checkout_code }}</span>
                            </div>
                        </div>
                        <div class="w-full overflow-x-auto">
                            <table class="min-w-full border border-blue-200 rounded-xl">
                                <thead class="bg-blue-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Menu</th>
                                        <th class="px-4 py-2 text-left">Harga</th>
                                        <th class="px-4 py-2 text-left">Jumlah</th>
                                        <th class="px-4 py-2 text-left">Metode</th>
                                        <th class="px-4 py-2 text-left">Catatan</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($group as $orderIndex => $order)
                                        @php $menu = $order->menu; @endphp
                                        <tr class="border-t border-blue-100 bg-blue-50 hover:bg-blue-200 transition">
                                            <td class="px-4 py-2 flex items-center gap-2">
                                                <img src="/images/{{ $menu->image_url ? $menu->image_url : 'default.jpg' }}" alt="{{ $menu->name }}" class="w-12 h-12 object-cover rounded-full border-2 border-blue-200">
                                                <span class="font-bold text-blue-900">{{ $menu->name }}</span>
                                            </td>
                                            <td class="px-4 py-2 text-red-700 font-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                            <td class="px-4 py-2 text-blue-900">{{ $order->quantity }} pcs</td>
                                            @if($orderIndex === 0)
                                                <td class="px-4 py-2 text-blue-900" rowspan="{{ $group->count() }}">{{ $order->payment_method }}</td>
                                            @endif
                                            <td class="px-4 py-2 text-gray-700 text-xs italic">{{ $order->buyer_request ?? '-' }}</td>
                                            <td class="px-4 py-2 text-blue-900">
                                                <span class="font-semibold">
                                                    @switch($order->status)
                                                        @case('pending') Menunggu Pembayaran @break
                                                        @case('proses') Proses Pemesanan @break
                                                        @case('dikirim') Dikirim @break
                                                        @case('selesai') Selesai @break
                                                        @default -
                                                    @endswitch
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if(!empty($checkout_code))
                            <form action="{{ route('admin.order.status.update', $checkout_code) }}" method="POST" class="mt-6 flex flex-col md:flex-row md:items-center gap-3">
                                @csrf
                                <label class="font-semibold text-blue-900">Update Status:</label>
                                <select name="status" class="border rounded px-2 py-1 text-sm">
                                    <option value="pending" @if($firstOrder->status=='pending') selected @endif>Menunggu Pembayaran</option>
                                    <option value="proses" @if($firstOrder->status=='proses') selected @endif>Proses Pemesanan</option>
                                    <option value="dikirim" @if($firstOrder->status=='dikirim') selected @endif>Dikirim (Kurir dalam Perjalanan)</option>
                                    <option value="selesai" @if($firstOrder->status=='selesai') selected @endif>Selesai</option>
                                </select>
                                <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded text-sm">Update Status</button>
                            </form>
                        @endif
                    </div>
                </div>
                @php $i++; @endphp
            @empty
                <div class="col-span-full text-gray-500 text-lg">Belum ada riwayat pemesanan.</div>
            @endforelse
        </div>
    @else
        @php
            $groupedOrders = $orders->groupBy('checkout_code');
        @endphp
        <div class="flex flex-col gap-6">
            @forelse($groupedOrders as $checkout_code => $group)
                @php
                    $firstOrder = $group->first();
                @endphp
                <div class="w-full mb-6">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 text-left border-2 border-blue-200 overflow-x-auto w-full">
                        <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <span class="font-bold text-blue-900">Pemesan:</span>
                                <span class="text-blue-800">{{ $firstOrder->user ? $firstOrder->user->name : '-' }}</span>
                            </div>
                            <div>
                                <span class="font-bold text-blue-900">Waktu Checkout:</span>
                                <span class="text-blue-800">{{ $firstOrder->created_at->format('d M Y') }}</span>
                            </div>
                            <div>
                                <span class="font-bold text-blue-900">Kode Checkout:</span>
                                <span class="text-blue-800">{{ $checkout_code }}</span>
                            </div>
                        </div>
                        <div class="w-full overflow-x-auto">
                            <table class="min-w-full border border-blue-200 rounded-xl">
                                <thead class="bg-blue-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Menu</th>
                                        <th class="px-4 py-2 text-left">Harga</th>
                                        <th class="px-4 py-2 text-left">Jumlah</th>
                                        <th class="px-4 py-2 text-left">Metode</th>
                                        <th class="px-4 py-2 text-left">Catatan</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                        <th class="px-4 py-2 text-left">Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $metodeDitampilkan = false; @endphp
                                    @foreach($group as $orderIndex => $order)
                                        @php $menu = $order->menu; @endphp
                                        <tr class="border-t border-blue-100 bg-blue-50 hover:bg-blue-200 transition">
                                            <td class="px-4 py-2 flex items-center gap-2">
                                                <img src="/images/{{ $menu->image_url ? $menu->image_url : 'default.jpg' }}" alt="{{ $menu->name }}" class="w-12 h-12 object-cover rounded-full border-2 border-blue-200">
                                                <span class="font-bold text-blue-900">{{ $menu->name }}</span>
                                            </td>
                                            <td class="px-4 py-2 text-red-700 font-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                            <td class="px-4 py-2 text-blue-900">{{ $order->quantity }} pcs</td>
                                            @if($orderIndex === 0)
                                                <td class="px-4 py-2 text-blue-900 text-center align-middle" rowspan="{{ $group->count() }}">{{ $order->payment_method }}</td>
                                            @endif
                                            <td class="px-4 py-2 text-gray-700 text-xs italic">{{ $order->buyer_request ?? '-' }}</td>
                                            <td class="px-4 py-2 text-blue-900">
                                                <span class="font-semibold">
                                                    @switch($order->status)
                                                        @case('pending') Menunggu Pembayaran @break
                                                        @case('proses') Proses Pemesanan @break
                                                        @case('dikirim') Dikirim @break
                                                        @case('selesai') Selesai @break
                                                        @default -
                                                    @endswitch
                                                </span>
                                            </td>
                                            <td class="px-4 py-2">
                                                <form action="{{ route('menu.rate', $menu->id) }}" method="POST" class="flex items-center gap-1 justify-center">
                                                    @csrf
                                                    @php $currentRating = $menu->rating ?? 0; @endphp
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <button type="submit" name="rating" value="{{ $i }}" class="focus:outline-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-6 w-6 {{ $currentRating > 0 ? ($i <= $currentRating ? 'text-yellow-400' : 'text-gray-300') : 'text-gray-300' }} hover:text-yellow-500 transition"
                                                                fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.175c.969 0 1.371 1.24.588 1.81l-3.382 2.453a1 1 0 00-.364 1.118l1.286 3.967c.3.921-.755 1.688-1.54 1.118l-3.382-2.453a1 1 0 00-1.176 0l-3.382 2.453c-.784.57-1.838-.197-1.54-1.118l1.286-3.967a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.381-1.81.588-1.81h4.175a1 1 0 00.95-.69l1.286-3.967z" />
                                                            </svg>
                                                        </button>
                                                    @endfor
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-gray-500 text-lg">Belum ada riwayat pemesanan.</div>
            @endforelse
        </div>
    @endif
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
