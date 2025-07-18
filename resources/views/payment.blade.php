<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KulinerKepri - Pembayaran</title>
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
                        <option value="qris">QRIS</option>
                        <option value="e_wallet">E-Wallet</option>
                    </select>
                    <div id="bank-options-container" class="mb-4" style="display:none;">
                        <label for="bank_option" class="block text-left text-gray-700 font-bold mb-2">Pilih Bank:</label>
                        <select id="bank_option" name="bank_option" class="w-full border-gray-300 rounded-lg mb-2">
                            <option value="bca">BCA</option>
                            <option value="bni">BNI</option>
                            <option value="bri">BRI</option>
                            <option value="mandiri">Mandiri</option>
                        </select>
                        <div id="rekening-info" class="text-blue-900 font-bold text-lg bg-blue-50 rounded p-2">
                            <span id="rekening-label">No. Rekening: </span>
                            <span id="rekening-value">1234567890 (BCA)</span>
                        </div>
                    </div>
        // Bank transfer show/hide logic
        const bankOptions = {
            bca: { rekening: '1234567890', label: 'BCA' },
            bni: { rekening: '9876543210', label: 'BNI' },
            bri: { rekening: '1122334455', label: 'BRI' },
            mandiri: { rekening: '5566778899', label: 'Mandiri' }
        };
        const bankOptionsContainer = document.getElementById('bank-options-container');
        const bankOptionSelect = document.getElementById('bank_option');
        const rekeningValue = document.getElementById('rekening-value');
        function toggleBankOptions() {
            if(paymentSelect.value === 'bank_transfer') {
                bankOptionsContainer.style.display = '';
                updateRekening();
            } else {
                bankOptionsContainer.style.display = 'none';
            }
        }
        function updateRekening() {
            const val = bankOptionSelect.value;
            rekeningValue.textContent = bankOptions[val].rekening + ' (' + bankOptions[val].label + ')';
        }
        if(bankOptionSelect) {
            bankOptionSelect.addEventListener('change', updateRekening);
        }
        paymentSelect.addEventListener('change', toggleBankOptions);
        // Inisialisasi saat load
        toggleBankOptions();
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
