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

    public function wakelDetail ($id) {
        $viewDataWakel = Wakel::find($id);
        return view("tampilan.data_pengguna.wakel.detail_wakel", compact('viewDataWakel'));
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

    public function wakelEdit ($id) {
        $editDataWakel = Wakel::find($id);
        return view("tampilan.data_pengguna.wakel.Edit_wakel", compact('editDataWakel'));
    }

    public function wakelUpdate(Request $request, $id) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_wakel' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = Wakel::find($id);
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_wakel')) {
            // Delete the old photo if exists
            if ($data->foto_wakel && Storage::disk('public')->exists($data->foto_wakel)) {
                Storage::disk('public')->delete($data->foto_wakel);
            }
    
            // Store the new photo
            $foto_wakel = $request->file('foto_wakel')->store('data_pengguna/foto_wakel', 'public');
            $data->foto_wakel = $foto_wakel;
        }

        $data->email=$request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('wakel.view');
    }

    public function wakelDelete($id) {
        
        $deleteDataWakel = Wakel::find($id);
        if ($deleteDataWakel) {
            // Delete the photo from storage if exists
            if ($deleteDataWakel->foto_wakel && Storage::disk('public')->exists($deleteDataWakel->foto_wakel)) {
                Storage::disk('public')->delete($deleteDataWakel->foto_wakel);
            }
    
            // Delete the siswa data from database
            $deleteDataWakel->delete();
    
            return redirect()->route('wakel.view');
        } 
        
    }

}