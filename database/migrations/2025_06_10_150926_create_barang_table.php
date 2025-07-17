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
    Schema::create('barang', function (Blueprint $table) {
        $table->id('id_barang');
        $table->unsignedBigInteger('id_user');
        $table->string('nama_barang');
        $table->string('kategori_barang');
        $table->string('lokasi');
        $table->decimal('harga', 10, 2);
        $table->string('no_telepon');
        $table->enum('kondisi_barang', ['baru', 'bekas']);
        $table->string('foto1')->nullable();
        $table->string('foto2')->nullable();
        $table->string('foto3')->nullable();
        $table->string('foto4')->nullable();
        $table->string('foto5')->nullable();
        $table->string('foto6')->nullable();
        $table->timestamps();
        $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
