<?php

namespace App\Http\Controllers\data_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kepsek;

class KepsekController extends Controller
{
    //
    public function kepsekView () {
        $data['allDataKepsek']=Kepsek::all();
        return view("tampilan.data_pengguna.kepsek.view_kepsek", $data);
    }
    public function kepsekAdd () {
        return view("tampilan.data_pengguna.kepsek.add_kepsek");
    }

    public function kepsekDetail () {
        return view("tampilan.data_pengguna.kepsek.detail_kepsek");
    }


    public function kepsekStore(Request $request) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_kepsek' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = new Kepsek();
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_kepsek')) {
            $foto_kepsek = $request->file('foto_kepsek')->store('kepsek/foto_kepsek', 'public');
            $data->foto_kepsek = $foto_kepsek;
        } else {
            $data->foto_kepsek = '';
        }
        $data->email=$request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('kepsek.view');
    }
    
    public function kepsekEdit () {
        return view("tampilan.data_pengguna.kepsek.edit_kepsek");
    }
}
