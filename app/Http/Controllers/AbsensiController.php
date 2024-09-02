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
use App\Helpers\TelegramHelper;
use Barryvdh\DomPDF\Facade\Pdf;

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

        public function unduhPerbulan()
        {
            // Mengambil bulan yang ada data absensinya, menggunakan format tahun-bulan
            $bulanAbsensi = Absensi::selectRaw('DISTINCT MONTH(tanggal) as bulan, YEAR(tanggal) as tahun')
                ->orderBy('tahun', 'desc')
                ->orderBy('bulan', 'desc')
                ->get();

                $absensi = Absensi::first();
        
            return view('tampilan.absensi.pilih_unduh_perbulan', compact('bulanAbsensi', 'absensi'));
        }

        public function unduhPerbulanPDF(Request $request)
        {
            $bulan = $request->input('bulan'); // Mendapatkan nilai bulan yang dipilih, misal: '2024-08'
            
            // Pisahkan tahun dan bulan dari format 'tahun-bulan'
            list($tahun, $bulan) = explode('-', $bulan);
        
            // Ambil absensi berdasarkan bulan dan tahun yang dipilih
            $absensi = Absensi::whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->with('siswa')
                ->get()
                ->groupBy('id_siswa') // Kelompokkan berdasarkan id_siswa
                ->map(function ($absensiSiswa) {
                    return $absensiSiswa->groupBy('tanggal'); // Kelompokkan lebih lanjut berdasarkan tanggal
                });
                
        
            // Hitung jumlah setiap status kehadiran per bulan
            $kehadiranPerBulan = Absensi::selectRaw('MONTH(tanggal) as bulan, YEAR(tanggal) as tahun, stts_kehadiran, COUNT(*) as jumlah')
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->groupBy('stts_kehadiran', 'bulan', 'tahun')
                ->get()
                ->groupBy('stts_kehadiran')
                ->map(function ($group) {
                    return $group->sum('jumlah');
                });
        
            $pdf = Pdf::loadView('tampilan.absensi.tampilan_unduh_perbulan', compact('absensi', 'bulan', 'kehadiranPerBulan'));
        
            return $pdf->download('Laporan-Absensi-' . $bulan . '.pdf');
        }
        


        public function unduhPersemester(Request $request)
        {
            // Query untuk mengambil semester yang terkait dengan mapel
            // Sesuaikan query ini dengan struktur tabel Anda
            $semesters = Mapel::select('semester')
                ->distinct()
                ->orderBy('semester', 'asc')
                ->get();

                $absensi = Absensi::first();
        
            // Kirim data semester ke view
            return view('tampilan.absensi.pilih_unduh_persemester', compact('semesters', 'absensi'));
        }

        public function unduhPersemesterPDF(Request $request)
        {
            $semester = $request->input('semester');
        
            // Ambil data absensi untuk semester yang dipilih
            $absensi = Absensi::whereHas('mapel', function ($query) use ($semester) {
                $query->where('semester', $semester);
            })
            ->with('siswa', 'mapel', 'mapel.guru', 'mapel.kelas') // Pastikan relasi yang diperlukan dimuat
            ->get()
            ->groupBy('id_siswa');
        
            // Ambil data mata pelajaran untuk digunakan dalam tampilan
            $mapelData = Absensi::whereHas('mapel', function ($query) use ($semester) {
                $query->where('semester', $semester);
            })
            ->with('mapel')
            ->get()
            ->groupBy('mapel_id')
            ->map(function ($items) {
                $mapel = $items->first()->mapel;
                return [
                    'nama_mapel' => $mapel->nm_mapel,
                    'kode_mapel' => $mapel->kd_mapel,
                    'kelas' => $mapel->kelas->nm_kelas,
                    'guru' => $mapel->guru->nama,
                    'semester' => $mapel->semester,
                    'tahun_pelajaran' => $mapel->tahpel->th_pelajaran
                ];
            })
            ->unique();
        
            // Hitung jumlah setiap status kehadiran per semester
            $kehadiranPerSemester = Absensi::selectRaw('YEAR(tanggal) as tahun, stts_kehadiran, COUNT(*) as jumlah')
                ->whereHas('mapel', function ($query) use ($semester) {
                    $query->where('semester', $semester);
                })
                ->groupBy('stts_kehadiran', 'tahun')
                ->get()
                ->groupBy('stts_kehadiran')
                ->map(function ($group) {
                    return $group->sum('jumlah');
                });
        
            // Debugging: Log the number of students and check data
            Log::info("Jumlah siswa dalam data absensi: " . $absensi->count());
            foreach ($absensi as $siswa_id => $data) {
                Log::info("ID Siswa: $siswa_id - Jumlah absensi: " . $data->count());
            }
        
            // Generate PDF from the view
            $pdf = Pdf::loadView('tampilan.absensi.tampilan_unduh_persemester', compact('absensi', 'semester', 'kehadiranPerSemester', 'mapelData'));
        
            // Download PDF
            return $pdf->download("Laporan-Absensi-Semester-$semester.pdf");
        }
        
       
}