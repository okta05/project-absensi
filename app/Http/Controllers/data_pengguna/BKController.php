<?php

namespace App\Http\Controllers\data_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bk;
use Illuminate\Support\Facades\Storage;

class BKController extends Controller
{
     //
     public function bkView () {
        $data['allDataBk']=Bk::all();
        return view("tampilan.data_pengguna.bk.view_bk", $data);
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
