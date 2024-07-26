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

    public function bkDetail ($id) {
        $viewDataBk = Bk::find($id);
        return view("tampilan.data_pengguna.bk.detail_bk", compact('viewDataBk'));
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

    public function bkEdit ($id) {
        $editDataBk = Bk::find($id);
        return view("tampilan.data_pengguna.bk.edit_bk", compact('editDataBk'));
    }

    public function bkUpdate(Request $request, $id) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_bk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = Bk::find($id);
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_bk')) {
            // Delete the old photo if exists
            if ($data->foto_bk && Storage::disk('public')->exists($data->foto_bk)) {
                Storage::disk('public')->delete($data->foto_bk);
            }
    
            // Store the new photo
            $foto_bk = $request->file('foto_bk')->store('data_pengguna/foto_bk', 'public');
            $data->foto_bk = $foto_bk;
        }

        $data->email=$request->email;
        if ($request->filled('password')) {
            $data->password = bcrypt($request->password);
        }
        $data->save();

        return redirect()->route('bk.view');
    }

    public function bkDelete($id) {
        
        $deleteDataBk = Bk::find($id);
        if ($deleteDataBk) {
            // Delete the photo from storage if exists
            if ($deleteDataBk->foto_bk && Storage::disk('public')->exists($deleteDataBk->foto_bk)) {
                Storage::disk('public')->delete($deleteDataBk->foto_bk);
            }
    
            // Delete the siswa data from database
            $deleteDataBk->delete();
    
            return redirect()->route('bk.view');
        } 
        
    }
}