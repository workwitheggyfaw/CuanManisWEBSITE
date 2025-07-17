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
    Schema::create('kos', function (Blueprint $table) {
        $table->id('id_kos');
        $table->unsignedBigInteger('id_user');
        $table->string('nama_kos');
        $table->enum('kategori_kos', ['putra', 'putri', 'campur']);
        $table->text('lokasi');
        $table->string('alamat');
        $table->decimal('harga', 10, 2);
        $table->string('nama_pemilik_kos');
        $table->string('no_telepon');
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
        Schema::dropIfExists('kos');
    }
};
