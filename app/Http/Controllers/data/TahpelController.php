<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tahpel;

class TahpelController extends Controller
{
    //
       public function tahpelView() {
        $data['allDataTahpel']=Tahpel::all();
        return view("tampilan.data.tahun_pelajaran.view_tahpel", $data);
    }

    public function tahpelAdd() {
        return view("tampilan.data.tahun_pelajaran.add_tahpel");
    }

    public function tahpelEdit() {
        return view("tampilan.data.tahun_pelajaran.edit_tahpel");
    }
}
