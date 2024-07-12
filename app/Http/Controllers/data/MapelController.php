<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    //
    public function mapelView() {
        return view("tampilan.data.mapel.view_mapel");
    }

    public function mapelAdd() {
        return view("tampilan.data.mapel.add_mapel");
    }

    public function mapeledit() {
        return view("tampilan.data.mapel.edit_mapel");
    }
}
