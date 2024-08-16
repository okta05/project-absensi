<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log facade
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
                $mapels = Mapel::where('id_guru', $guru->id_guru)->with('kelas')->get();
                Log::info('Mapel yang diambil: ' . $mapels->pluck('nm_mapel')->toJson());
            } else {
                Log::info('Guru tidak ditemukan, mengambil semua mapel');
                $mapels = Mapel::with('kelas')->get();
            }
        
            return view("tampilan.absensi.view_mapel_absensi", compact('mapels'));
}
}
