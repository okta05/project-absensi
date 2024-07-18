<?php

namespace App\Http\Controllers;
use App\Models\Admin;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function adminView() {
        
        $data['allDataAdmin']=Admin::all();
        return view('tampilan.admin.view_admin', $data); 
        
    }

    public function adminDetail() {
        return view('tampilan.admin.detail_admin');
    }

    public function adminAdd() {
        return view('tampilan.admin.add_admin');
    }

    public function adminStore(Request $request) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_admin' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = new Admin();
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_admin')) {
            $foto_admin = $request->file('foto_admin')->store('admin/foto_admin', 'public');
            $data->foto_admin = $foto_admin;
        } else {
            $data->foto_admin = '';
        }
        $data->email=$request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('admin.view')->with('message','Berhasil menambahkan Siswa');
    }

    public function adminEdit() {
        return view('tampilan.admin.edit_admin');
    }
}
