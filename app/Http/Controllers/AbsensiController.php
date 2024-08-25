<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log facade
use App\Models\Absensi;
use App\Models\Absensi_Detail;
use App\Models\Guru;
use App\Models\Mapel;
use DB;

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
                $data['allDataAbsensi'] = Absensi::select('id_mapel', 'tanggal', 'jam', DB::raw('MAX(id_absensi) as id_absensi'))
                ->where('id_mapel', $mapel_id)
                ->with('guru', 'kelas', 'tahpel', 'mapel')
                ->groupBy('id_mapel', 'tanggal', 'jam')
                ->get();

        
                // Mengambil data mapel berdasarkan id_mapel
                $data['mapel'] = Mapel::find($mapel_id);
            } else {
                // Jika id_mapel tidak ada, ambil semua data absensi tanpa pengelompokan
                $data['allDataAbsensi'] = Absensi::with('guru', 'kelas', 'tahpel', 'mapel')
                    ->get(); 
        
                $data['mapel'] = null;
            }
        
            // Render view dengan data absensi dan mapel
            return view("tampilan.absensi.pilih_data_absensi", $data);
        }

        public function absensiDetail($id) {
            $absensi = Absensi::with('mapel', 'kelas.siswa', 'guru', 'tahpel', 'siswa')->findOrFail($id);
    
           // Ambil data siswa berdasarkan kelas yang terkait dengan absensi
            $siswas = $absensi->kelas->siswa->sortBy('no_absen');
            
            return view('tampilan.absensi.detail_absensi', compact('absensi', 'siswas'));
        }
        

        public function absensiAdd(Request $request) {
            $mapel_id = $request->input('id_mapel');

            $data = [];
            if ($mapel_id) {
                // Ambil mata pelajaran dan kelas yang terkait
                $mapel = Mapel::with(['guru', 'kelas.siswa'])->find($mapel_id);
                $data['mapel'] = $mapel;
        
                // Ambil siswa sesuai dengan kelas dan urutkan berdasarkan no_absen
                $data['siswas'] = $mapel->kelas->siswa->sortBy('no_absen');
            } else {
                $data['mapel'] = null;
                $data['siswas'] = [];
            }
        
            return view("tampilan.absensi.add_absensi", $data);
        
        }

        public function absensiStore(Request $request) {
            // Validasi data absensi
            $validateData = $request->validate([
                'stts_kehadiran.*' => 'required|in:ijin,sakit,alpa,hadir',
            ]);
        
            // Ambil data label dari request
            $mapel_id = $request->input('id_mapel');
            $kelas_id = $request->input('id_kelas');
            $tahpel_id = $request->input('id_tahpel');
            $guru_id = $request->input('id_guru');
            $tanggal = $request->input('tanggal');
            $jam = $request->input('jam');

             // Ambil semua data kehadiran dan catatan dari request
             $kehadiran = $request->input('stts_kehadiran');
             $catatan = $request->input('catatan') ?? [];
         
             // Loop melalui setiap siswa dan simpan data absensi
             foreach ($kehadiran as $siswa_id => $status) {
                 Absensi::create([
                     'id_siswa' => $siswa_id,
                     'id_mapel' => $mapel_id,
                     'id_kelas' => $kelas_id,
                     'id_tahpel' => $tahpel_id,
                     'id_guru' => $guru_id,
                     'tanggal' => $tanggal,
                     'jam' => $jam,
                     'stts_kehadiran' => $status,
                     'catatan' => $catatan[$siswa_id] ?? null,
                 ]);
             }
         
             // Redirect ke halaman yang sesuai
             return redirect()->route('pilih_data.absensi', ['id_mapel' => $mapel_id])
                 ->with('success', 'Absensi berhasil disimpan');
         }
        
}