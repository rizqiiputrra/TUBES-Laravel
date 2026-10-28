<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();                                          // AUTO_INCREMENT PRIMARY KEY
            $table->string('kategori_tiket');                     // VARCHAR
            $table->integer('jumlah_tiket');                      // INT
            $table->integer('total_harga');                       // INT
            $table->string('metode_pembayaran')->nullable();      // VARCHAR, boleh null
            $table->string('nomor_va')->nullable();               // VARCHAR, boleh null
            $table->string('status_pembayaran')->default('Pending'); // VARCHAR, default 'Pending'
            $table->timestamps();                                 // created_at & updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
