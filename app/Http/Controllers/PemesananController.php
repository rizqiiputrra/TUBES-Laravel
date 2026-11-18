<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;


class PemesananController extends Controller
{
    // READ
    public function index(Request $request)
    {
        $pemesanans = Pemesanan::orderBy('id', 'desc')->get();
        $editData = null;

        if ($request->has('edit')) {
            $editData = Pemesanan::find($request->query('edit'));
        }

        return view('tiket', compact('pemesanans', 'editData'));
    }

    // CREATE
    public function store(Request $request)
    {
        $hargaSatuan = match ($request->kategori_tiket) {
            'Early Bird' => 50000,
            'Regular' => 100000,
            'VIP' => 250000,
            default => 0,
        };

        $totalHarga = $hargaSatuan * (int)$request->jumlah_tiket;

        $pemesanan = Pemesanan::create([
            'kategori_tiket' => $request->kategori_tiket,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $totalHarga,
            'status_pembayaran' => 'Pending',
        ]);

        return redirect()->route('pembayaran.show', $pemesanan->id);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $hargaSatuan = match ($request->kategori_tiket) {
            'Early Bird' => 50000,
            'Regular' => 100000,
            'VIP' => 250000,
            default => 0,
        };

        $totalHarga = $hargaSatuan * (int)$request->jumlah_tiket;

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update([
            'kategori_tiket' => $request->kategori_tiket,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $totalHarga,
        ]);

        return redirect()->route('tiket.index');
    }

    // DELETE
    public function destroy($id)
    {
        Pemesanan::destroy($id);
        return redirect()->route('tiket.index');
    }

    //
    public function pembayaran($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return view('pembayaran', compact('pemesanan'));
    }

    public function prosesPembayaran(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $metode = $request->kategori_pembayaran;
        $nomorVa = ($metode === 'VA') ? '8808' . rand(1000000000, 9999999999) : '-';

        $pemesanan->update([
            'metode_pembayaran' => $metode,
            'nomor_va' => $nomorVa,
            'status_pembayaran' => 'Berhasil',
        ]);

        return redirect()->route('pembayaran.show', $id)->with('show_result', true);
    }
}
