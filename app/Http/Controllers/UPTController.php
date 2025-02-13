<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ftw_tr_response;
use App\Models\ftw_tr_suratKeterangan;

class UPTController extends Controller
{
    public function show($page)
    {
        // Check if the view exists to prevent errors
        $validPages = ['absensi', 'beranda', 'index','resume', 'rekap', 'laporanMhs'];  // Add your valid pages here
        if ($page === 'absensi') {
            $kuisionerController = new KuisionerController();
            $response = $kuisionerController->show(1);
    
            // Check if the response is a redirect (error handling)
            if ($response instanceof \Illuminate\Http\RedirectResponse) {
                return $response;
            }
    
            return view('upts.absensi', ['questionnaire' => $response->getData()['questionnaire']]);
        }
        if ($page === 'rekap') {
            $responses = ftw_tr_response::where('res_responder_id', session('usr'))->get();
            return view('upts.rekap', ['responses' => $responses]);
        }

        if ($page === 'laporanMhs') {
            $suratKeterangan = ftw_tr_response::join('ftw_ms_mahasiswas', 'ftw_tr_responses.res_responder_id', '=', 'ftw_ms_mahasiswas.mhs_id')
                ->select('ftw_tr_responses.*', 'ftw_ms_mahasiswas.mhs_nama')
                ->get();
        
            return view('upts.laporanMhs', compact('suratKeterangan'));
        }

        if ($page === 'resume') {
            $userId = session('usr'); // Adjust this key based on your session structure
            $suratKeterangan = ftw_tr_suratKeterangan::where('usr_ID', $userId)->get(); // Change 'user_id' to the actual column name
            return view('upts.resume', compact('suratKeterangan'));
        }
        
        if (in_array($page, $validPages)) {
            return view('upts.' . $page);
        } else {
            abort(404); // Page not found
        }
    }
}
