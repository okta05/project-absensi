<?php

namespace App\Http\Controllers\data_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BKController extends Controller
{
     //
     public function bkView () {
        return view("tampilan.data_pengguna.bk.view_bk");
    }
    
    public function bkAdd () {
        return view("tampilan.data_pengguna.bk.add_bk");
    }
    public function bkDetail () {
        return view("tampilan.data_pengguna.bk.detail_bk");
    }

    public function bkEdit () {
        return view("tampilan.data_pengguna.bk.Edit_bk");
    }
}
