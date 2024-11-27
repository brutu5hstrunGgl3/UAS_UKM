<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            // Cek apakah kolom 'user_id' sudah ada, jika belum baru ditambahkan
            if (!Schema::hasColumn('pembayarans', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menambahkan kolom user_id yang merujuk ke kolom id di tabel users
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            // Hapus kolom user_id jika migration dibatalkan
            $table->dropColumn('user_id');
        });
    }

};
