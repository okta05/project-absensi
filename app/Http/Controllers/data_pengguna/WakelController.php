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

    public function wakelDetail () {
        return view("tampilan.data_pengguna.wakel.detail_wakel");
    }

    public function wakelAdd () {
        return view("tampilan.data_pengguna.wakel.add_wakel");
    }

    public function wakelStore(Request $request) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_wakel' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = new Wakel();
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_wakel')) {
            $foto_wakel = $request->file('foto_wakel')->store('data_pengguna/foto_wakel', 'public');
            $data->foto_wakel = $foto_wakel;
        } else {
            $data->foto_wakel = '';
        }
        $data->email=$request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('wakel.view');
    }

    public function wakelEdit () {
        return view("tampilan.data_pengguna.wakel.Edit_wakel");
    }
}
