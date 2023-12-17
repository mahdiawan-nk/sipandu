<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataIbu extends Model
{
    use HasFactory;
    protected $fillable= ['nik','nama','alamat','tempat_lahir','tanggal_lahir','agama','pekerjaan','no_hp','gol_darah','riwayat_kesehatan'];

    public function dataAnak(){
        return $this->hasMany(DataAnak::class,'id_ibu','id');
    }
}
