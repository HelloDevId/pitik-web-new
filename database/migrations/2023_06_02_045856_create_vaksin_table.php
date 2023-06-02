<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_vaksin', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_ovk');
            $table->string('jenis_ovk');
            $table->date('next_ovk');
            $table->integer('jumlah_ayam');
            $table->integer('biaya_ovk');
            $table->integer('total_biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_vaksin');
    }
};