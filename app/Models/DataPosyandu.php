<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPosyandu extends Model
{
    use HasFactory;
    protected $fillable =['nama_posyandu','alamat_posyandu','kader_posyandu','informasi_posyandu'];
}
