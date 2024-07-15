<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;;

class BkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('bks')->insert([
            'nama' => Str::random(4),
            'nip' => '11111111',
            'jns_kelamin' => 'Laki - laki',
            'alamat' => 'Rogojampi',
            'no_telp' => '08123456',
            'email' => Str::random(4).'@gmail.com',
            'password' => bcrypt('11111111'),
        ]);
    }
}
