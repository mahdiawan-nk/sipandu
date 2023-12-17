<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJenisImunisasi extends Model
{
    use HasFactory;
    protected $fillable = ['jenis_imunisasi','keterangan'];
}
