<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // generate code
        $length = 5;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        }

        $no_pegawai = 'NMK-'.Str::upper($random);

        $user = new User();
        $user->name = 'Super Admin';
        $user->email = 'superadmin@gmail.com';
        $user->password = bcrypt('rahasia');
        $user->role = 'superadmin';
        $user->save();

        Pegawai::create([
            'user_id'   => $user->id,
            'no_pegawai'    => $no_pegawai,
            'no_hp'         => '0897656523',
            'jk'            => 'Laki-laki',
            'tgl_lahir'     => '1990-01-01',
            'alamat'        => 'Jl. Raya Jakarta',
        ]);
    }
}
