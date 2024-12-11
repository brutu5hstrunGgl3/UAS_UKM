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
        Schema::create('kumpul_tugas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('judul_tugas');
            $table->string('kelas');
            $table->string('file')->nullable();
            $table->date('tanggal_upload')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kumpul_tugas');
    }
};
