<?php

namespace App\Models;

use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penghasilan extends Model
{
    use HasFactory;

    protected $table = 'tb_penghasilan';

    protected $fillable = [
        'id_pendapatan',
        'id_pengeluaran_ayam',
        'id_pengeluaran_vaksin',
        'id_pengeluaran_pakan',
        'id_pengeluaran_gaji',
        'tanggal',
    ];

    public function pendapatan()
    {
        return $this->belongsTo(Pendapatan::class, 'id_pendapatan', 'id');
    }

    public function pengeluaranayam()
    {
        return $this->belongsTo(PengeluaranAyam::class, 'id_pengeluaran_ayam', 'id');
    }

    public function pengeluaranvaksin()
    {
        return $this->belongsTo(PengeluaranVaksin::class, 'id_pengeluaran_vaksin', 'id');
    }

    public function pengeluaranpakan()
    {
        return $this->belongsTo(PengeluaranPakan::class, 'id_pengeluaran_pakan', 'id');
    }

    public function pengeluarangaji()
    {
        return $this->belongsTo(PengeluaranGaji::class, 'id_pengeluaran_gaji', 'id');
    }
}