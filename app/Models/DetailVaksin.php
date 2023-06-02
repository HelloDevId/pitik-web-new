<?php

namespace App\Models;

use App\Models\Vaksin;
use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailVaksin extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_pengeluaran_vaksin';

    protected $fillable =
        [
            'id_vaksin',
            'id_pengeluaran',
        ];

    public function vaksin()
    {
        return $this->belongsTo(Vaksin::class, 'id_vaksin', 'id');
    }

    public function pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class, 'id_pengeluaran', 'id');
    }
}