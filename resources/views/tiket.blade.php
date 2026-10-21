<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket & Kelola Pemesanan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>{{ $editData ? 'Edit Pemesanan Tiket' : 'Pendaftaran Event Masterclass' }}</h1>
    <p>Silakan {{ $editData ? 'ubah pilihan tiket kamu' : 'pilih kategori tiket yang ingin kamu beli' }} di bawah ini:</p>

    <form method="POST" action="{{ $editData ? route('tiket.update', $editData->id) : route('tiket.store') }}">
        @csrf
        @if($editData)
            @method('PUT')
        @endif

        <fieldset>
            <legend><b>Pilihan Kategori Tiket & Benefit</b></legend>
            @php $kat = $editData->kategori_tiket ?? ''; @endphp
            <p>
                <input type="radio" id="early_bird" name="kategori_tiket" value="Early Bird" required {{ $kat == 'Early Bird' ? 'checked' : '' }}>
                <label for="early_bird">
                    <strong>Early Bird - Rp 50.000</strong><br>
                    <small>Fasilitas: Akses Seminar, E-Sertifikat, Recording Materi</small>
                </label>
            </p>
            <p>
                <input type="radio" id="regular" name="kategori_tiket" value="Regular" {{ $kat == 'Regular' ? 'checked' : '' }}>
                <label for="regular">
                    <strong>Regular - Rp 100.000</strong><br>
                    <small>Fasilitas: Akses Seminar, E-Sertifikat</small>
                </label>
            </p>
            <p>
                <input type="radio" id="vip" name="kategori_tiket" value="VIP" {{ $kat == 'VIP' ? 'checked' : '' }}>
                <label for="vip">
                    <strong>VIP - Rp 250.000</strong><br>
                    <small>Fasilitas: Kursi Baris Depan, Q&A Eksklusif, Lunch</small>
                </label>
            </p>
        </fieldset>

        <label for="jumlah">Jumlah Tiket:</label><br>
        <input type="number" id="jumlah" name="jumlah_tiket" min="1" max="5" value="{{ $editData->jumlah_tiket ?? 1 }}">
        <br><br>

        <button type="submit">{{ $editData ? 'Simpan Perubahan' : 'Lanjut ke Pembayaran' }}</button>
        @if($editData)
            <a href="{{ route('tiket.index') }}" class="btn-kembali">Batal Edit</a>
        @else
            <button type="reset">Reset Pilihan</button>
        @endif
    </form>

    <div class="tabel-container">
        <h3>Daftar Pesanan Kamu</h3>
        <table>
            <thead>
                <tr>
                    <th>Tiket</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pemesanans as $row)
                    <tr>
                        <td>{{ $row->kategori_tiket }}</td>
                        <td>{{ $row->jumlah_tiket }}</td>
                        <td>Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                        <td><strong>{{ $row->status_pembayaran }}</strong></td>
                        <td>
                            @if ($row->status_pembayaran == 'Pending')
                                <a href="{{ route('pembayaran.show', $row->id) }}" class="btn-act btn-bayar">Bayar</a>
                            @endif
                            <a href="{{ route('tiket.index', ['edit' => $row->id]) }}" class="btn-act btn-edit">Edit</a>
                            <form action="{{ route('tiket.destroy', $row->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-act btn-delete" style="width:auto; padding:4px 8px;" onclick="return confirm('Hapus pesanan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;">Belum ada pemesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>