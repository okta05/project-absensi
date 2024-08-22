<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log facade
use App\Models\Absensi;
use App\Models\Absensi_Detail;
use App\Models\Guru;
use App\Models\Mapel;

class AbsensiController extends Controller
{
    //
        public function pilihMapel() {
            $user = Auth::user();
            Log::info('User yang login: ' . $user->id_guru);
        
            $guru = Guru::where('id_guru', $user->id_guru)->first();
            
            if ($guru) {
                Log::info('Guru ditemukan: ' . $guru->id_guru);
        
                // Ambil mata pelajaran yang dipegang guru yang login
                $mapels = Mapel::where('id_guru', $guru->id_guru)->with('kelas', 'guru')->get();
                Log::info('Mapel yang diambil: ' . $mapels->pluck('nm_mapel')->toJson());
            } else {
                Log::info('Guru tidak ditemukan, mengambil semua mapel');
                $mapels = Mapel::with('kelas')->get();
            }
        
            return view("tampilan.absensi.pilih_mapel_absensi", compact('mapels'));
        }

        public function pilihDataAbsensi(Request $request) {
            // Ambil id_mapel dari request atau session
            $mapel_id = $request->input('id_mapel') ?? session('current_mapel_id');
        
            if ($mapel_id) {
                // Mengambil data absensi berdasarkan id_mapel dan menampilkan semua entri dengan tanggal dan jam yang sama
                $data['allDataAbsensi'] = Absensi::where('id_mapel', $mapel_id)
                    ->with('guru', 'kelas', 'tahpel', 'mapel')
                    ->get(); // Hapus `groupBy` untuk menampilkan semua data
        
                // Mengambil data mapel berdasarkan id_mapel
                $data['mapel'] = Mapel::find($mapel_id);
            } else {
                // Jika id_mapel tidak ada, ambil semua data absensi tanpa pengelompokan
                $data['allDataAbsensi'] = Absensi::with('guru', 'kelas', 'tahpel', 'mapel')
                    ->get(); // Hapus `groupBy` untuk menampilkan semua data
        
                $data['mapel'] = null;
            }
        
            // Render view dengan data absensi dan mapel
            return view("tampilan.absensi.pilih_data_absensi", $data);
        }
        

        public function absensiAdd(Request $request) {
            $mapel_id = $request->input('id_mapel');

            $data = [];
            if ($mapel_id) {
                // Ambil mata pelajaran dan kelas yang terkait
                $mapel = Mapel::with(['guru', 'kelas.siswa'])->find($mapel_id);
                $data['mapel'] = $mapel;

                // Ambil siswa sesuai dengan kelas
                $data['siswas'] = $mapel->kelas->siswa;
            } else {
                $data['mapel'] = null;
                $data['siswas'] = [];
            }

            return view("tampilan.absensi.add_absensi", $data);
        
        }

        public function absensiStore(Request $request) {
            // Validasi data absensi
            $validateData = $request->validate([
                'stts_kehadiran.*' => 'required|in:ijin,sakit,alpa',
            ]);
        
            // Ambil data label dari request
            $mapel_id = $request->input('id_mapel');
            $kelas_id = $request->input('id_kelas');
            $tahpel_id = $request->input('id_tahpel');
            $guru_id = $request->input('id_guru');
            $tanggal = $request->input('tanggal');
            $jam = $request->input('jam');

            // Ambil siswa pertama dari inputan absensi
            $first_siswa_id = array_key_first($request->input('stts_kehadiran'));
            $status = $request->input('stts_kehadiran')[$first_siswa_id];
            $catatan = $request->input('catatan')[$first_siswa_id] ?? null;

            // Simpan hanya satu absensi untuk siswa pertama
            Absensi::create([
                'id_siswa' => $first_siswa_id,
                'id_mapel' => $mapel_id,
                'id_kelas' => $kelas_id,
                'id_tahpel' => $tahpel_id,
                'id_guru' => $guru_id,
                'tanggal' => $tanggal,
                'jam' => $jam,
                'stts_kehadiran' => $status,
                'catatan' => $catatan
            ]);

            // Redirect ke halaman yang sesuai
            return redirect()->route('pilih_data.absensi', ['id_mapel' => $mapel_id])
                ->with('success', 'Absensi berhasil disimpan');
        }
        
}