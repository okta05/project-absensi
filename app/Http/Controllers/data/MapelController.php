<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
    //
    public function mapelView() {
        $data['allDataMapel']=Mapel::all();
        return view("tampilan.data.mapel.view_mapel", $data);
    }

    public function mapelAdd() {
        return view("tampilan.data.mapel.add_mapel");
    }

    public function mapeledit() {
        return view("tampilan.data.mapel.edit_mapel");
    }
}
