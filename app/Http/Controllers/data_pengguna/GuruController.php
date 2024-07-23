<?php

namespace App\Http\Controllers\data_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
     //
     public function guruView () {
        $data['allDataGuru']=Guru::all();
        return view("tampilan.data_pengguna.guru.view_guru", $data);
    }

    public function guruDetail ($id) {
        $viewDataGuru = Guru::find($id);
        return view("tampilan.data_pengguna.guru.detail_guru", compact('viewDataGuru'));
    }

    public function guruAdd () {
        return view("tampilan.data_pengguna.guru.add_guru");
    }

    public function guruEdit () {
        return view("tampilan.data_pengguna.guru.Edit_guru");
    }
}