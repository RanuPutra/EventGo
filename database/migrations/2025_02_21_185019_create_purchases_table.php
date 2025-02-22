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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('pembeli');
            $table->foreignId('acara_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('tiket_id')->constrained('tickets')->onDelete('cascade');
            $table->integer('jumlah_tiket');
            $table->integer('total_harga');
            $table->enum('pembayaran', ['Transfer', 'Kartu_kredit', 'e-Wallet']);
            $table->enum('status', ['Pending', 'Berhasil', 'Gagal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
