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

    public function kurikulumDetail ($id) {
        $viewDataKurikulum = Kurikulum::find($id);
        return view("tampilan.data_pengguna.kurikulum.detail_kurikulum", compact('viewDataKurikulum'));
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

    public function kurikulumEdit ($id) {
        $editDataKurikulum = Kurikulum::find($id);
        return view("tampilan.data_pengguna.kurikulum.Edit_kurikulum", compact('editDataKurikulum'));
    }

    public function kurikulumUpdate(Request $request, $id) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_kurikulum' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = Kurikulum::find($id);
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_kurikulum')) {
            // Delete the old photo if exists
            if ($data->foto_kurikulum && Storage::disk('public')->exists($data->foto_kurikulum)) {
                Storage::disk('public')->delete($data->foto_kurikulum);
            }
    
            // Store the new photo
            $foto_kurikulum = $request->file('foto_kurikulum')->store('data_pengguna/foto_kurikulum', 'public');
            $data->foto_kurikulum = $foto_kurikulum;
        }

        $data->email=$request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('kurikulum.view');
    }

    public function kurikulumDelete($id) {
        
        $deleteDataKurikulum = Kurikulum::find($id);
        if ($deleteDataKurikulum) {
            // Delete the photo from storage if exists
            if ($deleteDataKurikulum->foto_kurikulum && Storage::disk('public')->exists($deleteDataKurikulum->foto_kurikulum)) {
                Storage::disk('public')->delete($deleteDataKurikulum->foto_kurikulum);
            }
    
            // Delete the siswa data from database
            $deleteDataKurikulum->delete();
    
            return redirect()->route('kurikulum.view');
        } 
        
    }
}