<?php

namespace App\Http\Controllers;
use App\Models\Siswa;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    //
    public function siswaView() {
        $data['allDataSiswa']=Siswa::all();
        return view('tampilan.siswa.view_siswa', $data);
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
