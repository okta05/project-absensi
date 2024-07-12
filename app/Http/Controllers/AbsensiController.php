<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    //
    public function pilihMapel() {
        return view("beranda.data.absensi.view_mapel_absensi");
    }
}
