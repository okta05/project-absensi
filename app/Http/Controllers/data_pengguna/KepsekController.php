<?php

namespace App\Http\Controllers\data_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kepsek;

class KepsekController extends Controller
{
    //
    public function kepsekView () {
        $data['allDataKepsek']=Kepsek::all();
        return view("tampilan.data_pengguna.kepsek.view_kepsek", $data);
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
