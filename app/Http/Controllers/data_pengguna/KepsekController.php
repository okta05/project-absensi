<?php

namespace App\Http\Controllers\data_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KepsekController extends Controller
{
    //
    public function kepsekView () {
        return view("tampilan.data_pengguna.kepsek.view_kepsek");
    }
    public function kepsekAdd () {
        return view("tampilan.data_pengguna.kepsek.add_kepsek");
    }

    public function kepsekDetail () {
        return view("tampilan.data_pengguna.kepsek.detail_kepsek");
    }

    
    public function kepsekEdit () {
        return view("tampilan.data_pengguna.kepsek.edit_kepsek");
    }
}
