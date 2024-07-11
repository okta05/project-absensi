<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KepsekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('kepsek')->insert([
            'name' => Str::random(4),
            'email' => Str::random(4).'@gmail.com',
            'password' => bcrypt('11111111'),
        ]);
    }
}
