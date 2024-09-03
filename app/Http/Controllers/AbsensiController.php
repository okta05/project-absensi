<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Absensi;
use App\Models\Absensi_Detail;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Helpers\TelegramHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;

class AbsensiController extends Controller
{
    //
    public function pilihMapel(Request $request)
    {
        // Ambil input filter dari request
        $nama_mapel = $request->input('nama_mapel');
        $nama_kelas = $request->input('nama_kelas');
        $nama_guru = $request->input('nama_guru');
    
        // Query dasar untuk mengambil data mata pelajaran
        $query = Mapel::query()->with('guru', 'kelas');
    
        // Filter berdasarkan nama mapel jika ada
        if ($nama_mapel) {
            $query->where('nm_mapel', 'like', '%' . $nama_mapel . '%');
        }
    
        // Filter berdasarkan nama kelas jika ada
        if ($nama_kelas) {
            $query->whereHas('kelas', function ($q) use ($nama_kelas) {
                $q->where('nm_kelas', 'like', '%' . $nama_kelas . '%');
            });
        }
    
        // Filter berdasarkan nama guru jika ada
        if ($nama_guru) {
            $query->whereHas('guru', function ($q) use ($nama_guru) {
                $q->where('nama', 'like', '%' . $nama_guru . '%');
            });
        }
    
        // Dapatkan data mapel setelah filter
        $mapels = $query->get();
    
        // Kirim data ke tampilan dengan data yang difilter
        return view('tampilan.absensi.pilih_mapel_absensi', compact('mapels'));
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
            $absensi = Absensi::with('mapel', 'kelas.siswa', 'guru', 'tahpel', 'siswa')
                ->findOrFail($id);
        
            // Ambil data absensi yang sesuai dengan tanggal dan jam
            $absensiDetails = Absensi::where('id_mapel', $absensi->id_mapel)
                ->where('tanggal', $absensi->tanggal)
                ->where('jam', $absensi->jam)
                ->with('siswa')
                ->get();
        
            // Ambil data siswa berdasarkan kelas yang terkait dengan absensi
            $siswas = $absensi->kelas->siswa->sortBy('no_absen');
            
            return view('tampilan.absensi.detail_absensi', compact('absensi', 'absensiDetails', 'siswas'));
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
            $validateData = $request->validate([
                'stts_kehadiran.*' => 'required|in:Ijin,Sakit,Alpa,Hadir,Belum Hadir',
            ]);
        
            $mapel_id = $request->input('id_mapel');
            $kelas_id = $request->input('id_kelas');
            $tahpel_id = $request->input('id_tahpel');
            $guru_id = $request->input('id_guru');
            $tanggal = $request->input('tanggal');
            $jam = $request->input('jam');
        
            $kehadiran = $request->input('stts_kehadiran');
            $catatan = $request->input('catatan') ?? [];
        
            foreach ($kehadiran as $siswa_id => $status) {
                $absensi = Absensi::create([
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
        
                // Kirim pesan ke Telegram setelah menyimpan absensi
                $siswa = $absensi->siswa;
                $chatId = $siswa->id_tel_ortu;
                $message = "Absensi: {$siswa->nama}\nTanggal: {$absensi->tanggal}\nJam: {$absensi->jam}\nStatus Kehadiran: {$absensi->stts_kehadiran}\nCatatan: {$absensi->catatan}";
        
                if ($chatId) {
                    TelegramHelper::sendMessage($chatId, $message);
                }
            }
        
            return redirect()->route('pilih_data.absensi', ['id_mapel' => $mapel_id])
                ->with('success', 'Absensi berhasil disimpan');
        }
        
        public function absensiEdit($id)
        {
            // Ambil data absensi berdasarkan ID
            $absensi = Absensi::with('mapel', 'kelas.siswa', 'guru', 'tahpel', 'siswa')
                ->findOrFail($id);

            // Ambil data absensi yang sesuai dengan tanggal dan jam untuk ditampilkan di form edit
            $absensiDetails = Absensi::where('id_mapel', $absensi->id_mapel)
                ->where('tanggal', $absensi->tanggal)
                ->where('jam', $absensi->jam)
                ->get();

            // Ambil data siswa berdasarkan kelas yang terkait dengan absensi
            $siswas = $absensi->kelas->siswa->sortBy('no_absen');

            return view('tampilan.absensi.edit_absensi', compact('absensi', 'absensiDetails', 'siswas'));
        }


        public function absensiUpdate(Request $request, $id)
        {
            $validateData = $request->validate([
                'stts_kehadiran.*' => 'required|in:Ijin,Sakit,Alpa,Hadir,Belum Hadir',
            ]);
        
            // Ambil data absensi berdasarkan ID absensi yang akan diperbarui
            $absensi = Absensi::findOrFail($id);
        
            // Loop melalui input status kehadiran dan catatan untuk setiap siswa
            foreach ($request->input('stts_kehadiran') as $siswa_id => $status) {
                // Perbarui data absensi untuk setiap siswa berdasarkan id_siswa
                Absensi::where('id_mapel', $absensi->id_mapel)
                    ->where('id_kelas', $absensi->id_kelas)
                    ->where('tanggal', $absensi->tanggal)
                    ->where('jam', $absensi->jam)
                    ->where('id_siswa', $siswa_id)
                    ->update([
                        'stts_kehadiran' => $status,
                        'catatan' => $request->input('catatan')[$siswa_id] ?? null,
                    ]);
            }
        
            return redirect()->route('pilih_data.absensi', ['id_mapel' => $absensi->id_mapel])
                ->with('success', 'Absensi berhasil diperbarui');
        }
        
        
        public function absensiDelete($id)
            {
                // Temukan data absensi berdasarkan ID
                $absensi = Absensi::findOrFail($id);
                
                // Ambil tanggal dan jam dari data absensi
                $tanggal = $absensi->tanggal;
                $jam = $absensi->jam;

                // Hapus semua data absensi yang memiliki tanggal dan jam yang sama
                Absensi::where('tanggal', $tanggal)
                    ->where('jam', $jam)
                    ->delete();
                
                // Redirect dengan pesan sukses
                return redirect()->route('pilih_data.absensi', ['id_mapel' => $absensi->id_mapel])
                    ->with('success', 'Semua absensi pada tanggal dan jam tersebut berhasil dihapus');
            }

        public function unduhPilihan ($id) {

            $absensi = Absensi::with('mapel', 'kelas.siswa', 'guru', 'tahpel', 'siswa')
            ->findOrFail($id);
    
        // Ambil data absensi yang sesuai dengan tanggal dan jam
        $absensiDetails = Absensi::where('id_mapel', $absensi->id_mapel)
            ->where('tanggal', $absensi->tanggal)
            ->where('jam', $absensi->jam)
            ->with('siswa')
            ->get();
    
        // Ambil data siswa berdasarkan kelas yang terkait dengan absensi
        $siswas = $absensi->kelas->siswa->sortBy('no_absen');

            return view('tampilan.absensi.pilih_unduh_absensi', compact('absensi', 'absensiDetails', 'siswas'));
        }

        public function unduhAbsensiPilihanPDF($id)
        {
            Log::info("Metode unduhAbsensiPilihanPDF dipanggil dengan ID: " . $id);
            
            $absensi = Absensi::with('mapel', 'kelas.siswa', 'guru', 'tahpel', 'siswa')
                ->findOrFail($id);

            $siswas = $absensi->kelas->siswa->sortBy('no_absen');

            $absensiDetails = Absensi::where('id_mapel', $absensi->id_mapel)
                ->where('tanggal', $absensi->tanggal)
                ->where('jam', $absensi->jam)
                ->with('siswa')
                ->get();

            $pdf = Pdf::loadView('tampilan.absensi.tampilan_absensi_pilihan', compact('absensi', 'absensiDetails', 'siswas'));

            return $pdf->download('Laporan-Absensi.pdf');
        }

        public function unduhPerbulan(Request $request)
        {
            // Simpan URL sebelumnya dalam session
            session()->put('previous_url', url()->previous());

            // Ambil id_mapel dari request
            $mapel_id = $request->input('id_mapel');

            if (!$mapel_id) {
                return redirect()->route('mapel.absensi')->with('error', 'ID Mata Pelajaran tidak ditemukan.');
            }

            // Ambil bulan-bulan unik dari tanggal absensi berdasarkan id_mapel
            $months = Absensi::select(DB::raw('MONTH(tanggal) as month'), DB::raw('YEAR(tanggal) as year'))
                ->where('id_mapel', $mapel_id)
                ->groupBy('month', 'year')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get();

            // Ambil mata pelajaran berdasarkan id_mapel
            $mapel = Mapel::find($mapel_id);

            return view('tampilan.absensi.pilih_unduh_perbulan', compact('months', 'mapel'));
        }

        public function unduhAbsensiPerBulan(Request $request)
        {
            // Simpan URL sebelumnya dalam session
            session()->put('previous_url', url()->previous());
        
            // Ambil id_mapel dan bulan dari request
            $mapel_id = $request->input('id_mapel');
            $bulan = $request->input('bulan');
        
            if (!$mapel_id || !$bulan) {
                return redirect()->route('absensi.perbulan')->with('error', 'ID Mata Pelajaran atau Bulan tidak ditemukan.');
            }
        
            // Ambil data absensi berdasarkan id_mapel dan bulan
            $absensi = Absensi::where('id_mapel', $mapel_id)
                ->whereYear('tanggal', substr($bulan, 0, 4))
                ->whereMonth('tanggal', substr($bulan, 5, 2))
                ->with('siswa')
                ->get();
        
            // Menghitung jumlah kehadiran dan ketidakhadiran per siswa
            $siswaAbsensi = $absensi->groupBy('id_siswa')->map(function ($items) {
                return [
                    'nama' => $items->first()->siswa->nama,
                    'hadir' => $items->where('stts_kehadiran', 'Hadir')->count(),
                    'belum hadir' => $items->where('stts_kehadiran', 'Belum Hadir')->count(),
                    'ijin' => $items->where('stts_kehadiran', 'Ijin')->count(),
                    'sakit' => $items->where('stts_kehadiran', 'Sakit')->count(),
                    'alpa' => $items->where('stts_kehadiran', 'Alpa')->count(),
                ];
            });
        
            // Menghitung total jumlah kehadiran per status
            $totalHadir = $siswaAbsensi->sum('hadir');
            $totalBelumHadir = $siswaAbsensi->sum('belum hadir');
            $totalIjin = $siswaAbsensi->sum('ijin');
            $totalSakit = $siswaAbsensi->sum('sakit');
            $totalAlpa = $siswaAbsensi->sum('alpa');
        
            $mapel = Mapel::find($mapel_id);
        
            // Mendapatkan data tambahan
            $guru = Guru::find($mapel->id_guru);
            $kelas = Kelas::find($mapel->id_kelas);
            $semester = $mapel->semester;
            $tahunPelajaran = $mapel->tahpel->th_pelajaran;
        
            // Generate PDF
            $pdf = Pdf::loadView('tampilan.absensi.tampilan_unduh_perbulan', compact('siswaAbsensi', 'mapel', 'totalHadir', 'totalBelumHadir', 'totalIjin', 'totalSakit', 'totalAlpa', 'guru', 'kelas', 'semester', 'tahunPelajaran'));
        
            return $pdf->download('Laporan-Absensi-Perbulan.pdf');
        }
        

        public function unduhPersemester(Request $request)
        {
            // Simpan URL sebelumnya dalam session
            session()->put('previous_url', url()->previous());
        
            // Ambil id_mapel dari request
            $mapel_id = $request->input('id_mapel');
        
            if (!$mapel_id) {
                return redirect()->route('mapel.absensi')->with('error', 'ID Mata Pelajaran tidak ditemukan.');
            }
        
            // Ambil data mata pelajaran berdasarkan id_mapel
            $mapel = Mapel::find($mapel_id);
        
            // Ambil semester dari mata pelajaran
            $semester = $mapel ? $mapel->semester : null;
        
            return view('tampilan.absensi.pilih_unduh_persemester', compact('mapel_id', 'semester'));
        }

        public function unduhAbsensiPerSemester(Request $request)
        {
            // Simpan URL sebelumnya dalam session
            session()->put('previous_url', url()->previous());

            // Ambil id_mapel dan semester dari request
            $mapel_id = $request->input('id_mapel');
            $semester = $request->input('semester');

            if (!$mapel_id || !$semester) {
                return redirect()->route('absensi.persemester')->with('error', 'ID Mata Pelajaran atau Semester tidak ditemukan.');
            }

            // Ambil data absensi berdasarkan id_mapel dan semester
            $absensi = Absensi::where('id_mapel', $mapel_id)
                ->whereHas('mapel', function ($query) use ($semester) {
                    $query->where('semester', $semester);
                })
                ->with('siswa')
                ->get();

            // Menghitung jumlah kehadiran dan ketidakhadiran per siswa
            $siswaAbsensi = $absensi->groupBy('id_siswa')->map(function ($items) {
                return [
                    'nama' => $items->first()->siswa->nama,
                    'no_absen' => $items->first()->siswa->no_absen,
                    'hadir' => $items->where('stts_kehadiran', 'Hadir')->count(),
                    'belum hadir' => $items->where('stts_kehadiran', 'Belum Hadir')->count(),
                    'ijin' => $items->where('stts_kehadiran', 'Ijin')->count(),
                    'sakit' => $items->where('stts_kehadiran', 'Sakit')->count(),
                    'alpa' => $items->where('stts_kehadiran', 'Alpa')->count(),
                ];
            });

            // Menghitung total jumlah kehadiran per status
            $totalHadir = $siswaAbsensi->sum('hadir');
            $totalBelumHadir = $siswaAbsensi->sum('belum hadir');
            $totalIjin = $siswaAbsensi->sum('ijin');
            $totalSakit = $siswaAbsensi->sum('sakit');
            $totalAlpa = $siswaAbsensi->sum('alpa');

            $mapel = Mapel::find($mapel_id);

            // Mendapatkan data tambahan
            $guru = Guru::find($mapel->id_guru);
            $kelas = Kelas::find($mapel->id_kelas);
            $tahunPelajaran = $mapel->tahpel->th_pelajaran;

            // Generate PDF
            $pdf = Pdf::loadView('tampilan.absensi.tampilan_unduh_persemester', compact('siswaAbsensi', 'mapel', 'totalHadir', 'totalBelumHadir', 'totalIjin', 'totalSakit', 'totalAlpa', 'guru', 'kelas', 'semester', 'tahunPelajaran'));

            return $pdf->download('Laporan-Absensi-Per-Semester.pdf');
        }

       
}