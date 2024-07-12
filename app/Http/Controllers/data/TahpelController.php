<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TahpelController extends Controller
{
    //
       public function tahpelView() {
        return view("tampilan.data.tahun_pelajaran.view_tahpel");
    }

    public function tahpelAdd() {
        return view("tampilan.data.tahun_pelajaran.add_tahpel");
    }

    public function tahpelEdit() {
        return view("tampilan.data.tahun_pelajaran.edit_tahpel");
    }
}
