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

    public function guruStore(Request $request) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_guru' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = new Guru();
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_guru')) {
            $foto_guru = $request->file('foto_guru')->store('data_pengguna/foto_guru', 'public');
            $data->foto_guru = $foto_guru;
        } else {
            $data->foto_guru = '';
        }
        $data->email=$request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('guru.view');
    }

    public function guruEdit ($id) {
        $editDataGuru = Guru::find($id);
        return view("tampilan.data_pengguna.guru.Edit_guru", compact('editDataGuru'));
    }

    public function guruUpdate(Request $request, $id) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_guru' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = Guru::find($id);
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_guru')) {
            // Delete the old photo if exists
            if ($data->foto_guru && Storage::disk('public')->exists($data->foto_guru)) {
                Storage::disk('public')->delete($data->foto_guru);
            }
    
            // Store the new photo
            $foto_guru = $request->file('foto_guru')->store('data_pengguna/foto_guru', 'public');
            $data->foto_guru = $foto_guru;
        }

        $data->email=$request->email;
        if ($request->filled('password')) {
            $data->password = bcrypt($request->password);
        }
        $data->save();

        return redirect()->route('guru.view');
    }

    public function guruDelete($id) {
        
        $deleteDataGuru = Guru::find($id);
        if ($deleteDataGuru) {
            // Delete the photo from storage if exists
            if ($deleteDataGuru->foto_guru && Storage::disk('public')->exists($deleteDataGuru->foto_guru)) {
                Storage::disk('public')->delete($deleteDataGuru->foto_guru);
            }
    
            // Delete the siswa data from database
            $deleteDataGuru->delete();
    
            return redirect()->route('wakel.view');
        } 
        
    }
}