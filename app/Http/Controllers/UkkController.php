<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UkkController extends Controller
{
    public function show($page)
    {
        if ($page === 'absensi') {
            $kuisionerController = new KuisionerController();
            $response = $kuisionerController->show(1);
    
            // Check if the response is a redirect (error handling)
            if ($response instanceof \Illuminate\Http\RedirectResponse) {
                return $response;
            }
    
            return view('ukks.absensi', ['questionnaire' => $response->getData()['questionnaire']]);
        }
        if (view()->exists("ukks.$page")) {
            return view("ukks.$page");
        } else {
            abort(404);
        }
    }

    public function cariMahasiswa($nim)
    {
        $mahasiswa = DB::table('ftw_ms_mahasiswas')->where('mhs_id', $nim)->first();

        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
        }

        return response()->json([
            'mhs_nama' => $mahasiswa->mhs_nama,
            'program_studi' => $mahasiswa->program_studi,
            'mhs_angkatan' => $mahasiswa->mhs_angkatan
        ]);
    }

    public function cariKaryawan($npk)
    {
        $karyawan = DB::table('ftw_ms_karyawans')->where('kry_id', $npk)->first();

        if (!$karyawan) {
            return response()->json(['error' => 'Karyawan tidak ditemukan'], 404);
        }

        return response()->json([
            'kry_nama_depan' => $karyawan->kry_nama_depan,
            'kry_nama_blk' => $karyawan->kry_nama_blk,
            'Bagian' => $karyawan->Bagian
        ]);
    }

    // public function cariResume(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:pdf|max:2048', // Maksimal 2MB
    //     ]);

    //     $file = $request->file('file');
    //     $fileName = time() . '_' . $file->getClientOriginalName();
    //     $file->move(public_path('uploads/resume'), $fileName);

    //     return back()->with('success', 'Resume berhasil dikirim!');
    // }

    public function store(Request $request)
{
    $request->validate([
        'tipe' => 'required|in:mahasiswa,karyawan',
        'nim' => 'required_if:tipe,mahasiswa|nullable|string',
        'npk' => 'required_if:tipe,karyawan|nullable|string',
        'tanggal' => 'required|date',
        'dokumen' => 'required|file|mimes:pdf|max:10240',
    ]);

    try {
        if ($request->tipe === 'mahasiswa') {
            $user = DB::table('ftw_ms_users')->where('usr_ID', $request->nim)->first();
        } else {
            $user = DB::table('ftw_ms_users')->where('usr_ID', $request->npk)->first();
        }

        if (!$user) {
            return redirect()->back()->withErrors(['msg' => 'Data pengguna tidak ditemukan. Pastikan NIM/NPK benar.']);
        }

        // Simpan file ke storage
        $path = $request->file('dokumen')->store('resumes');

        DB::table('ftw_tr_surat_keterangan')->insert([
            'usr_ID' => $user->usr_ID, 
            'skn_berkas' => $path,
            'skn_status' => 'Aktif', 
            'skn_created_by' => 'Furri Sukma', 
            'skn_created_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Resume berhasil dikirim!');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['msg' => 'Gagal menyimpan data. Coba lagi.']);
    }
}
}