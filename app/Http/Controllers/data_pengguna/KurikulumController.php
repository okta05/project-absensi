<?php

namespace App\Http\Controllers\data_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kurikulum;
use Illuminate\Support\Facades\Storage;

class KurikulumController extends Controller
{
    //
    public function kurikulumView() {
        $data['allDataKurikulum']=Kurikulum::all();
        return view("tampilan.data_pengguna.kurikulum.view_kurikulum", $data);
    }

    public function kurikulumDetail () {
        return view("tampilan.data_pengguna.kurikulum.detail_kurikulum");
    }

    public function kurikulumAdd () {
        return view("tampilan.data_pengguna.kurikulum.add_kurikulum");
    }

    public function kurikulumStore(Request $request) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_kurikulum' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = new Kurikulum();
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_kurikulum')) {
            $foto_kurikulum = $request->file('foto_kurikulum')->store('data_pengguna/foto_kurikulum', 'public');
            $data->foto_kurikulum = $foto_kurikulum;
        } else {
            $data->foto_kurikulum = '';
        }
        $data->email=$request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('kurikulum.view');
    }

    public function kurikulumEdit () {
        return view("tampilan.data_pengguna.kurikulum.Edit_kurikulum");
    }
}