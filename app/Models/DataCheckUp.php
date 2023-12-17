<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CheckUpImunisasi;
use App\Models\CheckUpVitamin;
use App\Models\DataPosyandu;

class DataCheckUp extends Model
{
    use HasFactory;
    protected $fillable = ['id_anak', 'id_posyandu', 'usia_saat_periksa', 'tanggal_pemeriksaan', 'berat_badan_pemeriksaan', 'tinggi_badan_pemeriksaan', 'status_gizi', 'status_imunisasi', 'status_vitamin'];
    public function dataAnak()
    {
        return $this->hasOne(DataAnak::class, 'id', 'id_anak');
    }

    public function dataImunisasi()
    {
        return $this->hasMany(CheckUpImunisasi::class, 'id_checkup', 'id');
    }

    public function dataPosyandu()
    {
        return $this->hasOne(DataPosyandu::class, 'id', 'id_posyandu');
    }

    public function dataVitamin()
    {
        return $this->hasMany(CheckUpVitamin::class, 'id_checkup', 'id');
    }

}
