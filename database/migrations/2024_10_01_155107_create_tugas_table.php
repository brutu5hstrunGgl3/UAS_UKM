<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id(); // Primary key dengan tipe bigint auto-increment
            $table->string('learning', 255)->nullable(); // Kolom learning dengan tipe varchar
            $table->string('lecturer', 255)->nullable(); // Kolom lecturer dengan tipe varchar
            $table->string('file', 255)->nullable(); // Kolom file untuk menyimpan nama file atau path
            $table->timestamps(); // Otomatis membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugas');
    }
}
