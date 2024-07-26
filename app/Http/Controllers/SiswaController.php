<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SiswaController extends Controller
{
    //
    public function siswaView() {
        $data['allDataSiswa']=Siswa::all();
        return view('tampilan.siswa.view_siswa', $data);
    }

    public function siswaDetail($id) {
        $viewDataSiswa = Siswa::find($id);
        return view('tampilan.siswa.detail_siswa', compact('viewDataSiswa'));
    }

    public function siswaAdd() {
        $idKelas = Kelas::all();
        return view('tampilan.siswa.add_siswa', compact('idKelas'));
    }

    public function siswaStore(Request $request) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_siswa' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = new Siswa();
        $data->nama=$request->textNama;
        $data->nis=$request->textNIS;
        $data->tgl_lahir=$request->text_tgl_lahir;
        $data->tpt_lahir=$request->text_tpt_lahir;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_siswa')) {
            $foto_siswa = $request->file('foto_siswa')->store('siswa/foto_siswa', 'public');
            $data->foto = $foto_siswa;
        } else {
            $data->foto = '';
        }

        $data->th_masuk=$request->text_th_masuk;
        $data->catatan=$request->textCatatan;
        $data->nm_ortu=$request->text_nm_ortu;
        $data->id_tel_ortu=$request->text_id_tel_ortu;
        $data->save();

        return redirect()->route('siswa.view')->with('message','Berhasil menambahkan Siswa');
    }

    public function siswaEdit($id) {

        $editDataSiswa = Siswa::find($id);
        return view('tampilan.siswa.edit_siswa', compact('editDataSiswa'));
    }

    public function siswaUpdate(Request $request, $id) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_siswa' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Menambahkan validasi untuk file image
        ]); 

        $data = Siswa::find($id);
        $data->nama=$request->textNama;
        $data->nis=$request->textNIS;
        $data->tgl_lahir=$request->text_tgl_lahir;
        $data->tpt_lahir=$request->text_tpt_lahir;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_siswa')) {
            // Delete the old photo if exists
            if ($data->foto && Storage::disk('public')->exists($data->foto)) {
                Storage::disk('public')->delete($data->foto);
            }
    
            // Store the new photo
            $foto_siswa = $request->file('foto_siswa')->store('siswa/foto_siswa', 'public');
            $data->foto = $foto_siswa;
        }

        $data->th_masuk=$request->text_th_masuk;
        $data->catatan=$request->textCatatan;
        $data->nm_ortu=$request->text_nm_ortu;
        $data->id_tel_ortu=$request->text_id_tel_ortu;
        $data->save();

        return redirect()->route('siswa.view')->with('message','Berhasil mengubah Siswa');
    }

    public function siswaDelete($id) {

    $deleteDataSiswa = Siswa::find($id);
    if ($deleteDataSiswa) {
        // Delete the photo from storage if exists
        if ($deleteDataSiswa->foto && Storage::disk('public')->exists($deleteDataSiswa->foto)) {
            Storage::disk('public')->delete($deleteDataSiswa->foto);
        }

        // Delete the siswa data from database
        $deleteDataSiswa->delete();

        return redirect()->route('siswa.view');
    } 
    }

}   