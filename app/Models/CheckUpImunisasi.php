<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataJenisImunisasi;

class CheckUpImunisasi extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_checkup',
        'id_imunisasi',
        'dosis',
        'tanggal_beri'
    ];

    public function dataJenisImunisasi()
    {
        return $this->belongsTo(DataJenisImunisasi::class, 'id_imunisasi', 'id');
    }

    public function dataCheckUp(){
        return $this->belongsTo(DataCheckUp::class, 'id_checkup', 'id');
    }

    
}
