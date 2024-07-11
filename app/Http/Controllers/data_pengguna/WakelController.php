<?php

namespace App\Http\Controllers\data_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WakelController extends Controller
{
    //
    public function wakelView () {
        return view("tampilan.data_pengguna.wakel.view_wakel");
    }

    public function wakelAdd () {
        return view("tampilan.data_pengguna.wakel.add_wakel");
    }
    public function wakelDetail () {
        return view("tampilan.data_pengguna.wakel.detail_wakel");
    }

    public function wakelEdit () {
        return view("tampilan.data_pengguna.wakel.Edit_wakel");
    }
}
