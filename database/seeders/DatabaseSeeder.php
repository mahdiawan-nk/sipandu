<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Pengguna::create([
            'nama_pengguna'=>'petugas-2',
            'password_pengguna'=>md5('123456'),
            'email_pengguna'=>'petugas-2@mail.com',
            'role'=>'P',
            'status_akun'=>'Y'
        ]);
    }
}
