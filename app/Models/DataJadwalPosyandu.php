<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataPosyandu;

class DataJadwalPosyandu extends Model
{
    use HasFactory;
    protected $fillable =['id_posyandu','start','end'];

    public function dataPosyandu()
    {
        return $this->hasOne(DataPosyandu::class, 'id', 'id_posyandu');
    }

}
