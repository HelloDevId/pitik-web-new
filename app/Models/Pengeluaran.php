<?php

namespace App\Models;

use App\Models\DetailAyam;
use App\Models\DetailGaji;
use App\Models\DetailPakan;
use App\Models\Penghasilan;
use App\Models\DetailVaksin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'tb_pengeluaran';

    protected $fillable = [
        'tanggal',
    ];

    public function detailayam()
    {
        return $this->hasMany(DetailAyam::class, 'id_pengeluaran', 'id');
    }

    public function detailgaji()
    {
        return $this->hasMany(DetailGaji::class, 'id_pengeluaran', 'id');
    }

    public function detailpakan()
    {
        return $this->hasMany(DetailPakan::class, 'id_pengeluaran', 'id');
    }

    public function detailvaksin()
    {
        return $this->hasMany(DetailVaksin::class, 'id_pengeluaran', 'id');
    }

    public function penghasilan()
    {
        return $this->hasOne(Penghasilan::class, 'id_pengeluaran', 'id');
    }

}
