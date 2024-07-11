<?php

namespace App\Http\Controllers\data_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    //
    public function kurikulumView() {
        return view("tampilan.data_pengguna.kurikulum.view_kurikulum");
    }

    public function kurikulumAdd () {
        return view("tampilan.data_pengguna.kurikulum.add_kurikulum");
    }
    public function kurikulumDetail () {
        return view("tampilan.data_pengguna.kurikulum.detail_kurikulum");
    }

    public function kurikulumEdit () {
        return view("tampilan.data_pengguna.kurikulum.Edit_kurikulum");
    }
}
