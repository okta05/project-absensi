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
            $guru = Auth::user();
            Log::info('User yang login: ' . $guru->id);
        
            $guru = Guru::where('id', $guru->id)->first();
            
            if ($guru) {
                Log::info('Guru ditemukan: ' . $guru->id);
        
                // Ambil mata pelajaran yang dipegang guru yang login
                $mapels = Mapel::where('id_guru', $guru->id)->get();
                Log::info('Mapel yang diambil: ' . $mapels->pluck('nm_mapel')->toJson());
            } else {
                Log::info('Guru tidak ditemukan, mengambil semua mapel');
                $mapels = Mapel::all();
            }
        
            return view("tampilan.absensi.view_mapel_absensi", compact('mapels'));
}
}
