<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    //
    public function pilihMapel() {
        return view("tampilan.absensi.view_mapel_absensi");
    }
}
