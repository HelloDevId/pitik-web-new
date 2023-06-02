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
        Schema::create('tb_distribusi', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->date('tanggal');
            $table->string('contact');
            $table->integer('total_ayam');
            $table->integer('harga_satuan');
            $table->integer('payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_distribusi');
    }
};