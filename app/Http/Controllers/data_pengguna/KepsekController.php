<?php

namespace App\Http\Controllers\data_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kepsek;
use Illuminate\Support\Facades\Storage;

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

    public function kepsekDetail ($id) {
        $viewDataKepsek = Kepsek::find($id);
        return view("tampilan.data_pengguna.kepsek.detail_kepsek",  compact('viewDataKepsek'));
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
            $foto_kepsek = $request->file('foto_kepsek')->store('data_pengguna/foto_kepsek', 'public');
            $data->foto_kepsek = $foto_kepsek;
        } else {
            $data->foto_kepsek = '';
        }
        $data->email=$request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('kepsek.view');
    }
    
    public function kepsekEdit ($id) {
        $editDataKepsek = Kepsek::find($id);
        return view("tampilan.data_pengguna.kepsek.edit_kepsek", compact('editDataKepsek'));
    }

    public function kepsekUpdate(Request $request, $id) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_kepsek' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = Kepsek::find($id);
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_kepsek')) {
            // Delete the old photo if exists
            if ($data->foto_kepsek && Storage::disk('public')->exists($data->foto_kepsek)) {
                Storage::disk('public')->delete($data->foto_admin);
            }
    
            // Store the new photo
            $foto_kepsek = $request->file('foto_kepsek')->store('data_pengguna/foto_kepsek', 'public');
            $data->foto_kepsek = $foto_kepsek;
        }

        $data->email=$request->email;
        if ($request->filled('password')) {
            $data->password = bcrypt($request->password);
        }
        $data->save();

        return redirect()->route('kepsek.view');
    }

    public function kepsekDelete($id) {
        
        $deleteDataKepsek = Kepsek::find($id);
        if ($deleteDataKepsek) {
            // Delete the photo from storage if exists
            if ($deleteDataKepsek->foto_kepsek && Storage::disk('public')->exists($deleteDataKepsek->foto_kepsek)) {
                Storage::disk('public')->delete($deleteDataKepsek->foto_kepsek);
            }
    
            // Delete the siswa data from database
            $deleteDataKepsek->delete();
    
            return redirect()->route('kepsek.view');
        } 
        
    }
}
