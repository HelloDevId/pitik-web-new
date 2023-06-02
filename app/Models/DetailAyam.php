<?php

namespace App\Models;

use App\Models\Ayam;
use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailAyam extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_pengeluaran_ayam';

    protected $fillable =
        [
            'id_ayam',
            'id_pengeluaran',
        ];

    public function ayam()
    {
        return $this->belongsTo(Ayam::class, 'id_ayam', 'id');
    }

    public function pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class, 'id_pengeluaran', 'id');
    }
}
