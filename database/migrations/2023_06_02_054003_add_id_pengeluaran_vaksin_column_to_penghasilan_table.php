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
        Schema::table('tb_penghasilan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pengeluaran_vaksin')->after('id')->default(2);
            $table->foreign('id_pengeluaran_vaksin')->references('id')->on('tb_pengeluaran_vaksin')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_pengasilan', function (Blueprint $table) {
            $table->dropForeign(['id_pengeluaran_vaksin']);
            $table->dropColumn('id_pengeluaran_vaksin');
        });
    }
};