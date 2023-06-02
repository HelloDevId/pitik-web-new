<?php

namespace App\Models;

use App\Models\Gaji;
use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailGaji extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_pengeluaran_gaji';

    protected $fillable =
        [
            'id_gaji',
            'id_pengeluaran',
        ];

    public function gaji()
    {
        return $this->belongsTo(Gaji::class, 'id_gaji', 'id');
    }

    public function pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class, 'id_pengeluaran', 'id');
    }


}