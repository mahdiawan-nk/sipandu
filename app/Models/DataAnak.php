<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataIbu;

class DataAnak extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_ibu',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'berat_lahir',
        'tinggi_lahir',
        'riwayat_kesehatan'
    ];

    public function dataIbu()
    {
        return $this->hasOne(DataIbu::class, 'id', 'id_ibu');
    }

}
