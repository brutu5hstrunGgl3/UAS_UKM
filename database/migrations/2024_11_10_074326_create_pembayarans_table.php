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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('no_telp')->nullable();  // Ubah menjadi string
            $table->string('email')->nullable();
            $table->string('jenis_paket');
            $table->decimal('harga', 8, 2);
            $table->string('status')->default('pending');
            $table->string('struk')->nullable();
            $table->date('tanggal_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
