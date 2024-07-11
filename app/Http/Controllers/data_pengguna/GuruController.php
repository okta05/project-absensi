<?php

namespace App\Http\Controllers\data_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuruController extends Controller
{
     //
     public function guruView () {
        return view("tampilan.data_pengguna.guru.view_guru");
    }

    public function guruAdd () {
        return view("tampilan.data_pengguna.guru.add_guru");
    }
    public function guruDetail () {
        return view("tampilan.data_pengguna.guru.detail_guru");
    }

    public function guruEdit () {
        return view("tampilan.data_pengguna.guru.Edit_guru");
    }
}
