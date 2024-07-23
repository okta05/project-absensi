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

    public function bkDetail () {
        return view("tampilan.data_pengguna.bk.detail_bk");
    }
    
    public function bkAdd () {
        return view("tampilan.data_pengguna.bk.add_bk");
    }

    public function bkStore(Request $request) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_bk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = new Bk();
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_bk')) {
            $foto_bk = $request->file('foto_bk')->store('data_pengguna/foto_bk', 'public');
            $data->foto_bk = $foto_bk;
        } else {
            $data->foto_bk = '';
        }
        $data->email=$request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('bk.view');
    }

    public function bkEdit () {
        return view("tampilan.data_pengguna.bk.Edit_bk");
    }
}