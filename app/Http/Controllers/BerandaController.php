<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Admin;
use App\Models\Kepsek;
use App\Models\Kurikulum;
use App\Models\Bk;
use App\Models\Wakel;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;

class BerandaController extends Controller
{
    //
    public function index(){
        $siswaCount = Siswa::count();
        $adminCount = Admin::count();
        $kepsekCount = Kepsek::count();
        $kurikulumCount = Kurikulum::count();
        $bkCount = Bk::count();
        $wakelCount = Wakel::count();
        $guruCount = Guru::count();
        $kelasCount = Kelas::count();
        $mapelCount = Mapel::count();
        
        return view('tampilan.index', compact('siswaCount','adminCount','kepsekCount',
        'kurikulumCount','bkCount','wakelCount','guruCount','kelasCount','mapelCount'));
    }
}