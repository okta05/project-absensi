<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log facade
use App\Models\Absensi;
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
            $mapel_id = $request->input('id_mapel')?? session('current_mapel_id');

            if ($mapel_id) {
                $data['allDataAbsensi'] = Absensi::where('id_mapel', $mapel_id)
                    ->with('guru', 'kelas', 'tahpel', 'mapel', 'siswa')
                    ->get();
                
                $data['mapel'] = Mapel::find($mapel_id);
            } else {
                $data['allDataAbsensi'] = Absensi::with('guru', 'kelas', 'tahpel', 'mapel', 'siswa')->get();
                $data['mapel'] = null;
            }
        
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
}