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
            $table->string('customer')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('contact')->nullable();
            $table->integer('total_ayam')->nullable();
            $table->integer('harga_satuan')->nullable();
            $table->integer('payment')->nullable();
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
