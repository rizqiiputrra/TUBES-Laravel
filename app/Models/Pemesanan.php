<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'kategori_tiket',
        'jumlah_tiket',
        'total_harga',
        'metode_pembayaran',
        'nomor_va',
        'status_pembayaran',
    ];
}
