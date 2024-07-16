<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    //
    public function siswaView() {
        $data['allDataSiswa']=Siswa::all();
        return view('tampilan.siswa.view_siswa', $data);
    }

    public function siswaDetail() {
        return view('tampilan.siswa.detail_siswa');
    }

    public function siswaAdd() {
        return view('tampilan.siswa.add_siswa');
    }

    public function siswaStore(Request $request) {

        $validateData=$request->validate([
            'textNama' => 'required',
        ]); 

        $data = new Siswa();
        $data->nama=$request->textNama;
        $data->nis=$request->textNIS;
        $data->tgl_lahir=$request->text_tgl_lahir;
        $data->tpt_lahir=$request->text_tpt_lahir;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;
        $data->th_masuk=$request->text_th_masuk;
        $data->catatan=$request->textCatatan;
        $data->nm_ortu=$request->text_nm_ortu;
        $data->id_tel_ortu=$request->text_id_tel_ortu;
        $data->save();

        return redirect()->route('siswa.view')->with('message','Berhasil menambahkan Siswa');
    }

    public function siswaEdit() {
        return view('tampilan.siswa.edit_siswa');
    }
}
