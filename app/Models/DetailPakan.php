<?php

namespace App\Models;

use App\Models\Pakan;
use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPakan extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_pengeluaran_pakan';

    protected $fillable =
        [
            'id_pakan',
            'id_pengeluaran',
        ];

    public function pakan()
    {
        return $this->belongsTo(Pakan::class, 'id_pakan', 'id');
    }

    public function pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class, 'id_pengeluaran', 'id');
    }
}