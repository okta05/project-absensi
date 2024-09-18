<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;


class SiswaController extends Controller
{
    //
    public function siswaView(Request $request) {
        // Membuat query dasar untuk mengambil data siswa dengan relasi kelas
        $query = Siswa::with('kelas');
    
        // Menambahkan filter jika nama diisi
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->input('nama') . '%');
        }
    
        // Menambahkan filter jika kelas diisi
        if ($request->filled('kelas')) {
            $query->where('id_kelas', $request->input('kelas'));
        }
    
        // Menambahkan filter jika jenis kelamin diisi
        if ($request->filled('jns_kelamin')) {
            $query->where('jns_kelamin', $request->input('jns_kelamin'));
        }
    
        // Mengambil data yang telah difilter
        $data['allDataSiswa'] = $query->get();
    
        // Mengambil semua data kelas untuk keperluan dropdown filter
        $data['kelas'] = Kelas::all();
    
        // Mengembalikan view dengan data siswa dan kelas
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
        $data->no_absen=$request->text_no_absen;
        $data->nama=$request->textNama;
        $data->nis=$request->textNIS;
        $data->tgl_lahir=$request->text_tgl_lahir;
        $data->tpt_lahir=$request->text_tpt_lahir;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;
        $data->id_kelas=$request->textKelas;

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
        $idKelas = Kelas::all();
        $editDataSiswa = Siswa::find($id);
        return view('tampilan.siswa.edit_siswa', compact('editDataSiswa', 'idKelas'));
    }

    public function siswaUpdate(Request $request, $id) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_siswa' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Menambahkan validasi untuk file image
        ]); 

        $data = Siswa::find($id);
        $data->no_absen=$request->text_no_absen;
        $data->nama=$request->textNama;
        $data->nis=$request->textNIS;
        $data->tgl_lahir=$request->text_tgl_lahir;
        $data->tpt_lahir=$request->text_tpt_lahir;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;
        $data->id_kelas=$request->textKelas;

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

    public function import(Request $request)
{
    // Validasi file
    $request->validate([
        'file' => 'required|mimes:xls,xlsx',
    ]);

    // Ambil semua kelas dari database untuk mapping nama ke ID
    $kelasMap = Kelas::pluck('id_kelas', 'nm_kelas')->toArray();

    // Baca file Excel
    $path = $request->file('file')->getRealPath();
    $spreadsheet = IOFactory::load($path);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    // Proses setiap baris dari Excel
    foreach ($rows as $key => $row) {
        // Lewati header (baris pertama)
        if ($key == 0) {
            continue;
        }

        // Mapping nama kelas ke ID kelas
        $idKelas = $kelasMap[$row[2]] ?? null;

        // Simpan data ke database hanya jika ID kelas valid
        if ($idKelas) {
            Siswa::create([
                'nama' => $row[0],
                'nis' => $row[1],
                'id_kelas' => $idKelas,
                'alamat' => $row[3],
                'jns_kelamin' => $row[4],
            ]);
        }
    }

    return redirect()->route('siswa.view');
}

}   