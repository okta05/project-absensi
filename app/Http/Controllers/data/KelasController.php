<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    //
    public function kelasView() {
        $data['allDataKelas']=Kelas::all();
        return view("tampilan.data.kelas.view_kelas", $data);
    }

    public function kelasAdd() {
        return view("tampilan.data.kelas.add_kelas");
    }

    public function kelasEdit() {
        return view("tampilan.data.kelas.edit_kelas");
    }
}
