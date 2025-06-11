<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KulineRiau - Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-6 py-20 text-center">
        <h1 class="text-4xl font-bold text-red-700 mb-8">Metode Pembayaran</h1>
        <p class="text-lg text-gray-700 max-w-xl mx-auto mb-6">Silakan pilih metode pembayaran untuk menu <strong>{{ $menu->name }}</strong>.</p>
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-2xl mx-auto">
            <form action="{{ route('payment.process') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
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
                    <textarea name="buyer_request" id="buyer_request" rows="4" class="w-full border-gray-300 rounded-lg" placeholder="Contoh: Tanpa pedas, tambahan saus."></textarea>
                </div>
                <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition">Pesan</button>
            </form>
        </div>
    </div>
</body>
</html>
