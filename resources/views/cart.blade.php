@extends('layouts.app')
@section('title', 'Keranjang Belanja')
@section('content')
<div class="container mx-auto px-2 md:px-6 py-8 md:py-16">
    <h1 class="text-3xl md:text-4xl font-bold text-red-700 mb-8 text-center">Keranjang Belanja</h1>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4 text-center">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4 text-center">{{ session('error') }}</div>
    @endif
    @if(count($cart) > 0)
    <form action="{{ route('cart.checkout') }}" method="POST" id="cartForm">
        @csrf
        <div class="bg-white rounded-xl shadow-lg divide-y divide-gray-100 max-w-3xl mx-auto">
            <div class="flex items-center px-4 py-3">
                <input type="checkbox" id="selectAll" class="w-6 h-6 text-green-600 border-gray-300 rounded mr-3">
                <label for="selectAll" class="font-semibold text-gray-700 select-none cursor-pointer">Pilih Semua</label>
            </div>
            @foreach($menus as $menu)
                @php
                    $qty = $cart[$menu->id];
                @endphp
                <div class="flex items-center px-4 py-4 group">
                    <input type="checkbox" name="selected_menus[]" value="{{ $menu->id }}" id="menu_{{ $menu->id }}" class="w-6 h-6 text-green-600 border-gray-300 rounded mr-3 select-item" data-id="{{ $menu->id }}">
                    <img src="/images/{{ $menu->image_url ? $menu->image_url : 'default.jpg' }}" alt="{{ $menu->name }}" class="w-20 h-20 object-cover rounded-lg border-2 border-blue-200 mr-4">
                    <div class="flex-1 text-left">
                        <h2 class="text-lg font-bold text-blue-900 mb-1">{{ $menu->name }}</h2>
                        <p class="text-gray-500 text-sm mb-1 line-clamp-2">{{ $menu->description }}</p>
                        <div class="flex items-center space-x-2 mb-1">
                            <span class="text-red-700 font-bold text-base">Rp <span class="harga-item" data-id="{{ $menu->id }}">{{ number_format($menu->price, 0, ',', '.') }}</span></span>
                        </div>
                        <div class="flex items-center space-x-2 mt-2">
                            <button type="button" class="decrement bg-gray-200 px-2 py-1 rounded text-lg font-bold" data-id="{{ $menu->id }}">-</button>
                            <input type="number" name="quantities[{{ $menu->id }}]" value="{{ $qty }}" min="1" class="w-14 text-center border border-gray-300 rounded px-2 py-1 font-semibold text-blue-900 quantity-input" data-id="{{ $menu->id }}" />
                            <button type="button" class="increment bg-gray-200 px-2 py-1 rounded text-lg font-bold" data-id="{{ $menu->id }}">+</button>
                        </div>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700 ml-2 btn-remove" data-id="{{ $menu->id }}" title="Hapus">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            @endforeach
        </div>
        <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-40">
            <div class="max-w-3xl mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-4">
                <div class="flex items-center mb-2 md:mb-0">
                    <span class="font-semibold text-gray-700 mr-2">Total:</span>
                    <span id="totalHarga" class="text-2xl font-bold text-red-700">Rp 0</span>
                </div>
                <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-green-700 transition w-full md:w-auto">Checkout</button>
            </div>
        </div>
        <div class="mt-8 max-w-3xl mx-auto bg-white rounded-xl shadow p-6">
            <h3 class="text-xl font-bold mb-4 text-blue-900">Detail Pengiriman</h3>
            <div class="mb-4">
                <label class="block text-left text-gray-700 font-bold mb-2">Alamat Pengiriman</label>
                <input type="text" name="shipping_address" value="{{ auth()->user()->address ?? '' }}" class="w-full border-gray-300 rounded-lg px-3 py-2 bg-gray-100" readonly>
            </div>
            <div class="mb-4">
                <label class="block text-left text-gray-700 font-bold mb-2">Nama Penerima</label>
                <input type="text" name="shipping_name" value="{{ auth()->user()->name ?? '' }}" class="w-full border-gray-300 rounded-lg px-3 py-2 bg-gray-100" readonly>
            </div>
            <div class="mb-4">
                <label class="block text-left text-gray-700 font-bold mb-2">No. Telepon Penerima</label>
                <input type="text" name="shipping_phone" value="{{ auth()->user()->phone ?? '' }}" class="w-full border-gray-300 rounded-lg px-3 py-2 bg-gray-100" readonly>
            </div>
            <div class="mb-4">
                <label class="block text-left text-gray-700 font-bold mb-2">Kota</label>
                <input type="text" name="shipping_city" value="{{ auth()->user()->city ?? '' }}" class="w-full border-gray-300 rounded-lg px-3 py-2 bg-gray-100" readonly>
            </div>
            <div class="mb-4">
                <label class="block text-left text-gray-700 font-bold mb-2">Kode Pos</label>
                <input type="text" name="shipping_postal_code" value="{{ auth()->user()->postal_code ?? '' }}" class="w-full border-gray-300 rounded-lg px-3 py-2 bg-gray-100" readonly>
            </div>
            <a href="/profile" class="text-blue-700 underline text-sm">Ubah alamat di profil</a>
            <h3 class="text-xl font-bold mb-4 text-blue-900 mt-8">Catatan/Permintaan Pembeli</h3>
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
        </div>
    </form>
    <script>
        // Select all logic
        document.getElementById('selectAll').addEventListener('change', function() {
            document.querySelectorAll('.select-item').forEach(cb => cb.checked = this.checked);
            updateTotal();
        });
        document.querySelectorAll('.select-item').forEach(cb => {
            cb.addEventListener('change', updateTotal);
        });
        // Increment/decrement logic
        document.querySelectorAll('.decrement').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const input = document.querySelector('.quantity-input[data-id="'+id+'"]');
                let val = parseInt(input.value);
                if(val > 1) input.value = val - 1;
                updateTotal();
            });
        });
        document.querySelectorAll('.increment').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const input = document.querySelector('.quantity-input[data-id="'+id+'"]');
                let val = parseInt(input.value);
                input.value = val + 1;
                updateTotal();
            });
        });
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('input', updateTotal);
        });
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.select-item').forEach(cb => {
                if(cb.checked) {
                    const id = cb.getAttribute('data-id');
                    const harga = parseInt(document.querySelector('.harga-item[data-id="'+id+'"]').innerText.replace(/\D/g, ''));
                    const qty = parseInt(document.querySelector('.quantity-input[data-id="'+id+'"]')?.value || 1);
                    total += harga * qty;
                }
            });
            document.getElementById('totalHarga').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }
        // Inisialisasi total awal
        updateTotal();

        // Validasi metode pembayaran dan item terpilih sebelum submit
        const cartForm = document.getElementById('cartForm');
        cartForm.addEventListener('submit', function(e) {
            const payment = document.getElementById('payment_method').value;
            const anyChecked = Array.from(document.querySelectorAll('.select-item')).some(cb => cb.checked);
            if(!anyChecked) {
                alert('Pilih minimal satu menu yang ingin dipesan!');
                e.preventDefault();
                return;
            }
            if(!payment) {
                alert('Silakan pilih metode pembayaran terlebih dahulu!');
                document.getElementById('payment_method').focus();
                document.getElementById('payment_method').scrollIntoView({behavior: 'smooth', block: 'center'});
                e.preventDefault();
            }
        });

        // Hapus item dari keranjang tanpa nested form
        document.querySelectorAll('.btn-remove').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                if(confirm('Yakin ingin menghapus item ini dari keranjang?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/cart/remove/' + id;
                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    </script>
    @else
        <div class="text-gray-500 text-lg text-center">Keranjang Anda kosong.</div>
    @endif
</div>
@endsection
