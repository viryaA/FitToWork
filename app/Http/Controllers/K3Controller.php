<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ftw_tr_response;

class K3Controller extends Controller
{
    public function show($page)
    {
        // Check if the view exists to prevent errors
        $validPages = ['absensi', 'beranda', 'index','resume', 'rekap', 'laporan_kecelakaan'];  // Add your valid pages here
        if ($page === 'absensi') {
            $kuisionerController = new KuisionerController();
            $response = $kuisionerController->show(1);
    
            // Check if the response is a redirect (error handling)
            if ($response instanceof \Illuminate\Http\RedirectResponse) {
                return $response;
            }
    
            return view('k3s.absensi', ['questionnaire' => $response->getData()['questionnaire']]);
        }
        if ($page === 'rekap') {
            $responses = ftw_tr_response::where('res_responder_id', session('usr'))->get();
            return view('k3s.rekap', ['responses' => $responses]);
        }
        if (in_array($page, $validPages)) {
            return view('k3s.' . $page);
        } else {
            abort(404); // Page not found
        }
    }
}
