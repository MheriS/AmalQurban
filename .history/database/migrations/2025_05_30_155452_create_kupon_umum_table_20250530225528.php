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
        Schema::create('kupon_umum', function (Blueprint $table) {
            $table->id();
            $table->string('no_kupon')->unique();
            $table->string('wilayah');
            $table->string('jatah'); // bisa juga integer + satuan di tampilan
            $table->string('jenis_daging'); // contoh: kambing, sapi
            $table->enum('status', ['Belum Scan', 'Sudah Scan'])->default('Belum Scan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kupon_umum');
    }
};
