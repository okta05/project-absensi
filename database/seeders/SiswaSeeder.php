<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('siswas')->insert([
            'nama' => 'Siswa 1',
            'nis' => '11111111',
            'tgl_lahir' => '1 Oktober 2001',
            'Banyuwangi' => '1 Oktober 2001',
            'jns_kelamin' => 'Laki - laki',
            'alamat' => 'Rogojampi',
            'no_telp' => '08123456',
        ]);
    }
}
