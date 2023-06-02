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
        'id_pengeluaran',
        'tanggal',
    ];

    public function pendapatan()
    {
        return $this->belongsTo(Pendapatan::class, 'id_pendapatan', 'id');
    }

    public function pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class, 'id_pengeluaran', 'id');
    }
}
