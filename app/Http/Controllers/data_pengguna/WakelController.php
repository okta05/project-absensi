<?php

namespace App\Http\Controllers\data_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wakel;
use Illuminate\Support\Facades\Storage;

class WakelController extends Controller
{
    //
    public function wakelView () {
        $data['allDataWakel']=Wakel::all();
        return view("tampilan.data_pengguna.wakel.view_wakel", $data);
    }

    public function wakelAdd () {
        return view("tampilan.data_pengguna.wakel.add_wakel");
    }
    public function wakelDetail () {
        return view("tampilan.data_pengguna.wakel.detail_wakel");
    }

    public function wakelEdit () {
        return view("tampilan.data_pengguna.wakel.Edit_wakel");
    }
}
