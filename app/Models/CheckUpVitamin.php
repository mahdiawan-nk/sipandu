<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckUpVitamin extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_checkup',
        'id_vitamin',
        'dosis',
        'tanggal_beri'
    ];
    public function dataJenisVitamin()
    {
        return $this->belongsTo(DataJenisVitamin::class, 'id_vitamin', 'id');
    }
    public function dataCheckUp(){
        return $this->belongsTo(DataCheckUp::class, 'id_checkup', 'id');
    }
}
