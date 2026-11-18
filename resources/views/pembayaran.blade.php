<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembayaran</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Konfirmasi & Pembayaran</h1>
    <p>Silakan selesaikan pembayaran untuk tiket event kamu.</p>

    @if ($pemesanan)
        <div class="ringkasan-box">
            <h3>Rincian Pemesanan</h3>
            <p><strong>Kategori Tiket:</strong> {{ $pemesanan->kategori_tiket }}</p>
            <p><strong>Jumlah Tiket:</strong> {{ $pemesanan->jumlah_tiket }} tiket</p>
            <p style="font-size: 18px; color: #4a90e2; margin-top: 10px;">
                <strong>Total Pembayaran:</strong> Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
            </p>
        </div>
    @endif

    <form method="POST" action="{{ route('pembayaran.update', $pemesanan->id) }}">
        @csrf
        <fieldset>
            <legend><b>Pilihan Metode Pembayaran</b></legend>
            <p>
                <input type="radio" id="VA" name="kategori_pembayaran" value="VA" required {{ $pemesanan->metode_pembayaran == 'VA' ? 'checked' : '' }}>
                <label for="VA"><strong>Virtual Account Bank</strong></label>
            </p>
            <p>
                <input type="radio" id="QRIS" name="kategori_pembayaran" value="QRIS" {{ $pemesanan->metode_pembayaran == 'QRIS' ? 'checked' : '' }}>
                <label for="QRIS"><strong>QRIS</strong></label>
            </p>
        </fieldset>

        <button type="submit">Generate Pembayaran</button>
        <a href="{{ route('tiket.index') }}" class="btn-kembali">Kembali ke Tiket</a>
    </form>

    @if (session('show_result') || $pemesanan->status_pembayaran === 'Berhasil')
        <div class="hasil-pembayaran">
            @if ($pemesanan->metode_pembayaran == 'VA')
                <h3>Instruksi Pembayaran Virtual Account</h3>
                <p>Transfer sebesar <strong>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</strong> ke nomor VA berikut:</p>
                <div class="box-info">
                    <strong>{{ $pemesanan->nomor_va }}</strong>
                </div>
                <small>*Data pembayaran berhasil disimpan!</small>
            @elseif ($pemesanan->metode_pembayaran == 'QRIS')
                <h3>Scan QRIS di bawah ini</h3>
                <p>Total Bayar: <strong>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</strong></p>
                <div class="qr-container">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=ContohQRIS" alt="QR Code Pembayaran">
                </div>
                <small>*Data pembayaran berhasil disimpan!</small>
            @endif
        </div>
    @endif
</body>
</html>