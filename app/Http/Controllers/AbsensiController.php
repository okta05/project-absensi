<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tahpel;
use App\Helpers\TelegramHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AbsensiController extends Controller
{

    public function pilihMapel(Request $request)
    {
        // Ambil input filter dari request
        $nama_mapel = $request->input('nama_mapel'); //nama_mapel untuk name di filter
        $nama_kelas = $request->input('nama_kelas');
        $nama_guru = $request->input('nama_guru');

        $query = Mapel::query()->with('guru', 'kelas');

        // Cek apakah user yang login adalah guru
        $user = Auth::user();
        $guru = Guru::where('email', $user->email)->first(); // cek guru berdasarkan email

        // Jika yang login adalah guru, ambil mapel yang di ampu
        if ($guru) {
            $query->where('id_guru', $guru->id_guru); // menyesuiakan dengan fk guru
        }

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

        $mapels = $query->get();

        return view('tampilan.absensi.pilih_mapel_absensi', compact('mapels'));
    }

    public function pilihDataAbsensi(Request $request)
    {
        // Ambil id_mapel dari sesi atau input
        $mapel_id = $request->input('id_mapel') ?? session('current_mapel_id');

        // Jika id_mapel tidak ada, arahkan kembali ke halaman pemilihan mapel
        if (!$mapel_id) {
            return redirect()->route('mapel.absensi');
        }

        // Cek jika tombol reset ditekan
        if ($request->has('reset')) {
            session()->forget('filter_tanggal'); // Hapus filter tanggal dari sesi
            $tanggal = null; // Atur tanggal filter menjadi null
        } else {
            // Ambil filter tanggal dari request atau sesi
            $tanggal = $request->input('tanggal') ?? session('filter_tanggal');

            // Simpan filter tanggal dalam sesi jika ada input tanggal
            if ($request->has('tanggal')) {
                session(['filter_tanggal' => $tanggal]);
            }
        }

        // Query untuk mengambil data absensi
        $query = Absensi::select('id_mapel', 'tanggal', 'jam', DB::raw('MAX(id_absensi) as id_absensi'))
            ->where('id_mapel', $mapel_id)
            ->with('guru', 'kelas', 'tahpel', 'mapel')
            ->groupBy('id_mapel', 'tanggal', 'jam');

        // Filter data berdasarkan tanggal jika ada filter
        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        $data['allDataAbsensi'] = $query->get();

        // Mengambil data mapel berdasarkan id_mapel
        $data['mapel'] = Mapel::find($mapel_id);

        return view("tampilan.absensi.pilih_data_absensi", $data);
    }

    public function absensiDetail($id)
    {
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

    public function absensiAdd(Request $request)
    {
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

    public function absensiStore(Request $request)
    {
        $validateData = $request->validate([
            'stts_kehadiran.*' => 'nullable|in:Ijin,Sakit,Alpa,Hadir,Belum Hadir',
        ]);

        $mapel_id = $request->input('id_mapel');
        $kelas_id = $request->input('id_kelas');
        $tahpel_id = $request->input('id_tahpel');
        $guru_id = $request->input('id_guru');
        $tanggal = $request->input('tanggal');
        $jam = $request->input('jam');

        $kehadiran = $request->input('stts_kehadiran', []);
        $catatan = $request->input('catatan', []);

        // Ambil semua siswa dari kelas yang sedang diabsen
        $siswas = Siswa::where('id_kelas', $kelas_id)->get();

        foreach ($siswas as $siswa) {
            // Set status kehadiran default menjadi 'Belum Hadir' jika tidak dipilih
            $status = $kehadiran[$siswa->id_siswa] ?? 'Belum Hadir';
            $note = $catatan[$siswa->id_siswa] ?? null;

            $absensi = Absensi::create([
                'id_siswa' => $siswa->id_siswa,
                'id_mapel' => $mapel_id,
                'id_kelas' => $kelas_id,
                'id_tahpel' => $tahpel_id,
                'id_guru' => $guru_id,
                'tanggal' => $tanggal,
                'jam' => $jam,
                'stts_kehadiran' => $status,
                'catatan' => $note,
            ]);

            // Kirim pesan ke Telegram setelah menyimpan absensi
            $chatId = $siswa->id_tel_ortu;
            $message = "Absensi: {$siswa->nama}\nTanggal: {$absensi->tanggal}\nJam: {$absensi->jam}\nStatus Kehadiran: {$absensi->stts_kehadiran}\nCatatan: {$absensi->catatan}";

            if ($chatId) {
                TelegramHelper::sendMessage($chatId, $message);
            }
        }

        return redirect()->route('pilih_data.absensi', ['id_mapel' => $mapel_id]);
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

        return redirect()->route('pilih_data.absensi', ['id_mapel' => $absensi->id_mapel]);
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
        return redirect()->route('pilih_data.absensi', ['id_mapel' => $absensi->id_mapel]);
    }

    public function unduhPilihan($id)
    {
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
        $absensi = Absensi::with('mapel', 'kelas.siswa', 'guru', 'tahpel', 'siswa')
            ->findOrFail($id);

        $absensiDetails = Absensi::where('id_mapel', $absensi->id_mapel)
            ->where('tanggal', $absensi->tanggal)
            ->where('jam', $absensi->jam)
            ->with('siswa')
            ->get()
            ->sortBy('siswa.no_absen'); // Urutkan berdasarkan no_absen

        $pdf = Pdf::loadView('tampilan.absensi.tampilan_absensi_pilihan', compact('absensi', 'absensiDetails'));

        return $pdf->download('Laporan-Absensi.pdf');
    }

    public function unduhPerbulan(Request $request)
    {
        // Simpan URL sebelumnya dalam session
        session()->put('previous_url', url()->previous());

        // Ambil id_mapel dan bulan dari request
        $mapel_id = $request->input('id_mapel');
        $selected_month = $request->input('bulan');

        if (!$mapel_id) {
            return redirect()->route('mapel.absensi');
        }

        // Ambil bulan-bulan unik dari tanggal absensi berdasarkan id_mapel
        $months = Absensi::select(DB::raw('MONTH(tanggal) as month'), DB::raw('YEAR(tanggal) as year'))
            ->where('id_mapel', $mapel_id)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->distinct() // Pastikan hasilnya unik
            ->get();

        // Ambil mata pelajaran berdasarkan id_mapel
        $mapel = Mapel::find($mapel_id);

        // Jika bulan dipilih, ambil data absensi berdasarkan bulan yang dipilih
        $absensi = [];
        if ($selected_month) {
            $absensi = Absensi::where('id_mapel', $mapel_id)
                ->whereYear('tanggal', substr($selected_month, 0, 4))  // Ambil tahun dari 'YYYY-MM'
                ->whereMonth('tanggal', substr($selected_month, 5, 2)) // Ambil bulan dari 'YYYY-MM'
                ->with('siswa') // Eager load relasi siswa
                ->get();
        }

        return view('tampilan.absensi.pilih_unduh_perbulan', compact('months', 'mapel', 'absensi', 'selected_month'));
    }

    public function tampilkanPerbulan(Request $request)
    {
        // Ambil id_mapel dan bulan dari request
        $mapel_id = $request->input('id_mapel');
        $selected_month = $request->input('bulan');

        if (!$mapel_id) {
            return redirect()->route('mapel.absensi');
        }

        // Ambil bulan-bulan unik dari tanggal absensi berdasarkan id_mapel
        $months = Absensi::select(DB::raw('MONTH(tanggal) as month'), DB::raw('YEAR(tanggal) as year'))
            ->where('id_mapel', $mapel_id)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->distinct() // Pastikan hasilnya unik
            ->get();

        // Ambil mata pelajaran berdasarkan id_mapel
        $mapel = Mapel::find($mapel_id);

        // Ambil data absensi berdasarkan bulan yang dipilih
        $grouped_absensi = [];
        if ($selected_month) {
            $absensi = Absensi::where('id_mapel', $mapel_id)
                ->whereYear('tanggal', substr($selected_month, 0, 4))  // Ambil tahun dari 'YYYY-MM'
                ->whereMonth('tanggal', substr($selected_month, 5, 2)) // Ambil bulan dari 'YYYY-MM'
                ->with('siswa') // Eager load relasi siswa
                ->get();

            // Kelompokkan data absensi berdasarkan tanggal dan jam
            foreach ($absensi as $data) {
                $tanggal = Carbon::parse($data->tanggal)->format('d-m-Y');
                $jam = Carbon::parse($data->jam)->format('H:i');

                $grouped_absensi[$tanggal][$jam][] = $data;
            }
        }

        return view('tampilan.absensi.pilih_unduh_perbulan', compact('months', 'mapel', 'grouped_absensi', 'selected_month'));
    }

    public function unduhAbsensiPerBulan(Request $request)
    {
        // Simpan URL sebelumnya dalam session
        session()->put('previous_url', url()->previous());

        // Ambil id_mapel dan bulan dari request
        $mapel_id = $request->input('id_mapel');
        $bulan = $request->input('bulan');

        if (!$mapel_id || !$bulan) {
            return redirect()->route('absensi.perbulan');
        }

        // Ambil data absensi berdasarkan id_mapel dan bulan
        $absensi = Absensi::where('id_mapel', $mapel_id)
            ->whereYear('tanggal', substr($bulan, 0, 4))
            ->whereMonth('tanggal', substr($bulan, 5, 2))
            ->with('siswa')
            ->get();

        // Menghitung jumlah kehadiran dan ketidakhadiran per siswa
        // Menghitung jumlah kehadiran dan ketidakhadiran per siswa
        $siswaAbsensi = $absensi->groupBy('id_siswa')->map(function ($items) {
            return [
                'nama' => $items->first()->siswa->nama,
                'no_absen' => $items->first()->siswa->no_absen,
                'nis' => $items->first()->siswa->nis,
                'hadir' => $items->where('stts_kehadiran', 'Hadir')->count(),
                'belum hadir' => $items->where('stts_kehadiran', 'Belum Hadir')->count(),
                'ijin' => $items->where('stts_kehadiran', 'Ijin')->count(),
                'sakit' => $items->where('stts_kehadiran', 'Sakit')->count(),
                'alpa' => $items->where('stts_kehadiran', 'Alpa')->count(),
                'tanggal_hadir' => $items->where('stts_kehadiran', 'Hadir')->pluck('tanggal')->toArray(),
                'tanggal_belum_hadir' => $items->where('stts_kehadiran', 'Belum Hadir')->pluck('tanggal')->toArray(),
                'tanggal_ijin' => $items->where('stts_kehadiran', 'Ijin')->pluck('tanggal')->toArray(),
                'tanggal_sakit' => $items->where('stts_kehadiran', 'Sakit')->pluck('tanggal')->toArray(),
                'tanggal_alpa' => $items->where('stts_kehadiran', 'Alpa')->pluck('tanggal')->toArray(),
            ];
        });

        // Mengurutkan siswa berdasarkan no_absen
        $siswaAbsensi = $siswaAbsensi->sortBy('no_absen');

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
        $pdf = Pdf::loadView('tampilan.absensi.tampilan_unduh_perbulan', compact(
            'siswaAbsensi',
            'mapel',
            'totalHadir',
            'totalBelumHadir',
            'totalIjin',
            'totalSakit',
            'totalAlpa',
            'guru',
            'kelas',
            'semester',
            'tahunPelajaran'
        ));

        return $pdf->download('Laporan-Absensi-Perbulan.pdf');
    }

    public function unduhPersemester(Request $request)
    {
        session()->put('previous_url', url()->previous());

        $mapel_id = $request->input('id_mapel');

        if (!$mapel_id) {
            return redirect()->route('mapel.absensi');
        }

        // Ambil data mata pelajaran berdasarkan id_mapel
        $mapel = Mapel::find($mapel_id);

        // Ambil semester dari mata pelajaran
        $semester = $mapel ? $mapel->semester : null;

        // Ambil data absensi berdasarkan id_mapel, dikelompokkan berdasarkan tanggal dan jam
        $absensi = Absensi::where('id_mapel', $mapel_id)
            ->select('tanggal', 'jam')
            ->groupBy('tanggal', 'jam')
            ->get();

        // Fetch the unique ids for each group to pass to the view
        $absensiIds = Absensi::where('id_mapel', $mapel_id)
            ->whereIn('tanggal', $absensi->pluck('tanggal'))
            ->whereIn('jam', $absensi->pluck('jam'))
            ->get(['id_absensi', 'tanggal', 'jam']);

        return view('tampilan.absensi.pilih_unduh_persemester', compact('mapel_id', 'mapel', 'semester', 'absensi', 'absensiIds'));
    }

    public function unduhAbsensiPerSemester(Request $request)
    {
        // Simpan URL sebelumnya dalam session
        session()->put('previous_url', url()->previous());

        // Ambil id_mapel dan semester dari request
        $mapel_id = $request->input('id_mapel');
        $semester = $request->input('semester');

        if (!$mapel_id || !$semester) {
            return redirect()->route('absensi.persemester');
        }

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
                'nis' => $items->first()->siswa->nis,
                'hadir' => $items->where('stts_kehadiran', 'Hadir')->count(),
                'belum_hadir' => $items->where('stts_kehadiran', 'Belum Hadir')->count(), // Pastikan key ini konsisten
                'ijin' => $items->where('stts_kehadiran', 'Ijin')->count(),
                'sakit' => $items->where('stts_kehadiran', 'Sakit')->count(),
                'alpa' => $items->where('stts_kehadiran', 'Alpa')->count(),
                'tanggal_hadir' => $items->where('stts_kehadiran', 'Hadir')->pluck('tanggal')->toArray(),
                'tanggal_belum_hadir' => $items->where('stts_kehadiran', 'Belum Hadir')->pluck('tanggal')->toArray(),
                'tanggal_ijin' => $items->where('stts_kehadiran', 'Ijin')->pluck('tanggal')->toArray(),
                'tanggal_sakit' => $items->where('stts_kehadiran', 'Sakit')->pluck('tanggal')->toArray(),
                'tanggal_alpa' => $items->where('stts_kehadiran', 'Alpa')->pluck('tanggal')->toArray(),
            ];
        });


        // Memastikan ada data untuk bulan yang bersangkutan
        $siswaAbsensiBulan = [];
        foreach ($absensi as $item) {
            $bulan = \Carbon\Carbon::parse($item->tanggal)->format('F Y'); // Mengambil bulan dan tahun
            $siswaId = $item->id_siswa;

            // Inisialisasi array untuk bulan dan siswa jika belum ada
            if (!isset($siswaAbsensiBulan[$bulan])) {
                $siswaAbsensiBulan[$bulan] = [];
            }

            if (!isset($siswaAbsensiBulan[$bulan][$siswaId])) {
                $siswaAbsensiBulan[$bulan][$siswaId] = [
                    'nama' => $item->siswa->nama,
                    'nis' => $item->siswa->nis,
                    'tanggal_hadir' => [],
                    'tanggal_belum_hadir' => [],
                    'tanggal_ijin' => [],
                    'tanggal_sakit' => [],
                    'tanggal_alpa' => [],
                ];
            }

            // Menambahkan tanggal ke kategori yang sesuai
            switch ($item->stts_kehadiran) {
                case 'Hadir':
                    $siswaAbsensiBulan[$bulan][$siswaId]['tanggal_hadir'][] = \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y');
                    break;
                case 'Belum Hadir':
                    $siswaAbsensiBulan[$bulan][$siswaId]['tanggal_belum_hadir'][] = \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y');

                    break;
                case 'Ijin':
                    $siswaAbsensiBulan[$bulan][$siswaId]['tanggal_ijin'][] = \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y');

                    break;
                case 'Sakit':
                    $siswaAbsensiBulan[$bulan][$siswaId]['tanggal_sakit'][] = \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y');

                    break;
                case 'Alpa':
                    $siswaAbsensiBulan[$bulan][$siswaId]['tanggal_alpa'][] = \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y');

                    break;
            }
        }

        // Memastikan bahwa hasilnya adalah array siswa
        foreach ($siswaAbsensiBulan as $bulan => $siswaData) {
            $siswaAbsensiBulan[$bulan] = array_values($siswaData);
        }


        // Mengurutkan siswa berdasarkan no_absen
        $siswaAbsensi = $siswaAbsensi->sortBy('no_absen');

        // Menghitung total jumlah kehadiran per status
        $totalHadir = $siswaAbsensi->sum('hadir');
        $totalBelumHadir = $siswaAbsensi->sum('belum_hadir');
        $totalIjin = $siswaAbsensi->sum('ijin');
        $totalSakit = $siswaAbsensi->sum('sakit');
        $totalAlpa = $siswaAbsensi->sum('alpa');

        $mapel = Mapel::find($mapel_id);

        // Mendapatkan data tambahan
        $guru = Guru::find($mapel->id_guru);
        $kelas = Kelas::find($mapel->id_kelas);
        $tahunPelajaran = $mapel->tahpel->th_pelajaran;

        // Generate PDF
        $pdf = Pdf::loadView('tampilan.absensi.tampilan_unduh_persemester', compact(
            'siswaAbsensi',
            'siswaAbsensiBulan',
            'mapel',
            'totalHadir',
            'totalBelumHadir',
            'totalIjin',
            'totalSakit',
            'totalAlpa',
            'guru',
            'kelas',
            'semester',
            'tahunPelajaran'
        ));


        return $pdf->download('Laporan-Absensi-Per-Semester.pdf');
    }

    public function importExcel(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Ambil file dari request
        $file = $request->file('file');

        // Membaca file Excel
        $spreadsheet = IOFactory::load($file->getRealPath());
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $id_mapel_valid = null; // Untuk menyimpan ID mapel yang valid
        $processed_rows = 0; // Counter untuk mengecek berapa baris yang diproses

        // Looping data
        foreach ($rows as $key => $row) {
            // Lewati header jika ada
            if ($key == 0) {
                continue;
            }

            // Debugging: cek setiap baris yang sedang diproses
            Log::info("Memproses baris ke-{$key} dengan data: ", $row);

            // Proses data siswa dan absensi
            $nis = $row[9]; // Asumsi kolom ke-10 berisi NIS siswa
            $status_kehadiran = $row[10]; // Asumsi kolom ke-12 berisi status kehadiran
            $tanggal = $row[5]; // Asumsi kolom ke-7 berisi tanggal
            $jam = $row[6]; // Asumsi kolom ke-8 berisi jam
            $tahpel = $row[4]; // Asumsi kolom ke-8 berisi jam

            // Cari nama guru, kelas, mapel dari excel
            $nama_guru = $row[3]; // Asumsi kolom ke-4 berisi nama guru
            $nama_kelas = $row[2]; // Asumsi kolom ke-3 berisi nama kelas
            $nama_mapel = $row[0]; // Asumsi kolom ke-1 berisi nama mata pelajaran

            // Cari ID guru, kelas, mapel berdasarkan nama
            $guru = Guru::where('nama', $nama_guru)->first();
            $kelas = Kelas::where('nm_kelas', $nama_kelas)->first();
            $mapel = Mapel::where('nm_mapel', operator: $nama_mapel)->first();
            $tahun_pelajaran = Tahpel::where('th_pelajaran', $tahpel)->first();

            // Debugging: Cek apakah guru, kelas, atau mapel ditemukan
            if (!$guru) {
                Log::warning("Guru '{$nama_guru}' tidak ditemukan.");
            }
            if (!$kelas) {
                Log::warning("Kelas '{$nama_kelas}' tidak ditemukan.");
            }
            if (!$mapel) {
                Log::warning("Mapel '{$nama_mapel}' tidak ditemukan.");
            }

            // Jika tidak ditemukan guru, kelas, atau mapel, lewati baris ini
            if (!$guru || !$kelas || !$mapel) {
                continue;
            }

            // Simpan ID mapel yang valid
            $id_mapel_valid = $mapel->id_mapel;

            // Cari siswa berdasarkan NIS
            $siswa = Siswa::where('nis', $nis)->first();

            // Jika siswa ditemukan, simpan data absensi
            if ($siswa) {
                Absensi::create([
                    'id_siswa' => $siswa->id_siswa,
                    'id_mapel' => $mapel->id_mapel, // Gunakan ID mapel yang ditemukan
                    'id_kelas' => $kelas->id_kelas, // Gunakan ID kelas yang ditemukan
                    'id_tahpel' => $tahun_pelajaran->id_tahpel, // Anda bisa menambahkan logika untuk mendapatkan id_tahpel
                    'id_guru' => $guru->id_guru, // Gunakan ID guru yang ditemukan
                    'tanggal' => $tanggal,
                    'jam' => $jam,
                    'stts_kehadiran' => $status_kehadiran,
                    'catatan' => $row[11], // Asumsi kolom ke-13 berisi catatan
                ]);

                // Debugging: Beri log saat data berhasil dibuat
                Log::info("Data absensi untuk siswa '{$siswa->nama}' berhasil disimpan.");
                $processed_rows++; // Tambah counter untuk baris yang berhasil diproses
            } else {
                Log::warning("Siswa dengan NIS '{$nis}' tidak ditemukan.");
            }
        }

        // Jika ID mapel valid, lakukan redirect, jika tidak, berikan pesan kesalahan
        if ($id_mapel_valid) {
            return redirect()->route('pilih_data.absensi', ['id_mapel' => $id_mapel_valid])
                ->with('success', "Data absensi berhasil diimport. {$processed_rows} baris berhasil diproses.");
        } else {
            return redirect()->back()->with('error', 'Data mapel tidak ditemukan dalam file.');
        }
    }

    public function detailUnduhPerbulan($id)
    {
        session()->put('previous_url', url()->previous());

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

        return view('tampilan.absensi.detail_unduh_perbulan', compact('absensi', 'absensiDetails', 'siswas'));
    }

    public function detailUnduhPersemester($id)
    {
        session()->put('previous_url', url()->previous());

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

        return view('tampilan.absensi.detail_unduh_persemester', compact('absensi', 'absensiDetails', 'siswas'));
    }
}