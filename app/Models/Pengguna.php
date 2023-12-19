<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataPosyandu;

class Pengguna extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pengguna', 'email_pengguna', 'password_pengguna', 'role', 'status_akun', 'id_posyandu'];

    public function dataPosyandu()
    {
        return $this->belongsTo(DataPosyandu::class, 'id_posyandu', 'id');
    }
}
