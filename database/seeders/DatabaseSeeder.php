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
            'nama_pengguna'=>'Administrator',
            'password_pengguna'=>md5('123456'),
            'email_pengguna'=>'admins@mail.com',
            'role'=>'A',
            'status_akun'=>'Y'
        ]);
    }
}
