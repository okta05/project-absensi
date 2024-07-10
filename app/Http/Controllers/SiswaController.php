<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    //
    public function siswaView() {
        return view('tampilan.siswa.view_siswa');
    }

    public function siswaDetail() {
        return view('tampilan.siswa.detail_siswa');
    }

    public function siswaAdd() {
        return view('tampilan.siswa.add_siswa');
    }

    public function siswaEdit() {
        return view('tampilan.siswa.edit_siswa');
    }
}
