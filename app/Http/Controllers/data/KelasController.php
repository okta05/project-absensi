<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    //
    public function kelasView() {
        return view("tampilan.data.kelas.view_kelas");
    }

    public function kelasAdd() {
        return view("tampilan.data.kelas.add_kelas");
    }

    public function kelasEdit() {
        return view("tampilan.data.kelas.edit_kelas");
    }
}
