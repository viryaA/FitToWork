<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ftw_tr_response;
use App\Models\ftw_tr_suratKeterangan;
use Illuminate\Support\Facades\DB;

class GAController extends Controller
{
    public function show($page)
    {
        // Check if the view exists to prevent errors
        $validPages = ['absensi', 'beranda', 'index','resume', 'rekap', 'laporanMhs','laporanKry'];  // Add your valid pages here
        if ($page === 'absensi') {
            $kuisionerController = new KuisionerController();
            $response = $kuisionerController->show(1);
    
            // Check if the response is a redirect (error handling)
            if ($response instanceof \Illuminate\Http\RedirectResponse) {
                return $response;
            }
    
            return view('gas.absensi', ['questionnaire' => $response->getData()['questionnaire']]);
        }
        if ($page === 'rekap') {
            $responses = ftw_tr_response::where('res_responder_id', session('usr'))->get();
            return view('gas.rekap', ['responses' => $responses]);
        }

        if ($page === 'laporanMhs') {
            $suratKeterangan = ftw_tr_response::join('ftw_ms_mahasiswas', 'ftw_tr_responses.res_responder_id', '=', 'ftw_ms_mahasiswas.mhs_id')
                ->select('ftw_tr_responses.*', 'ftw_ms_mahasiswas.mhs_nama')
                ->get();
        
            return view('gas.laporanMhs', compact('suratKeterangan'));
        }

        if ($page === 'laporanKry') {
            $suratKeterangan = ftw_tr_response::join('ftw_ms_karyawans', 'ftw_tr_responses.res_responder_id', '=', 'ftw_ms_karyawans.kry_id')
                ->select(
                    'ftw_tr_responses.*',
                    DB::raw("CONCAT(ftw_ms_karyawans.kry_nama_depan, ' ', ftw_ms_karyawans.kry_nama_blk) AS kry_nama")
                )
                ->get();
                
            return view('gas.laporanKry', compact('suratKeterangan'));
        }

        if ($page === 'resume') {
            $userId = session('usr'); // Adjust this key based on your session structure
            $suratKeterangan = ftw_tr_suratKeterangan::where('usr_ID', $userId)->get(); // Change 'user_id' to the actual column name
            return view('gas.resume', compact('suratKeterangan'));
        }

        if (in_array($page, $validPages)) {
            return view('gas.' . $page);
        } else {
            abort(404); // Page not found
        }
    }
}
