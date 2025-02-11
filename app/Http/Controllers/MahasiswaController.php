<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ftw_tr_suratKeterangan;

class MahasiswaController extends Controller
{
    public function show($page)
    {
        // Check if the view exists to prevent errors
        $validPages = ['absensi', 'beranda', 'index','resume', 'rekap'];  // Add your valid pages here
        if ($page === 'absensi') {
            $kuisionerController = new KuisionerController();
            $response = $kuisionerController->show(1);
    
            // Check if the response is a redirect (error handling)
            if ($response instanceof \Illuminate\Http\RedirectResponse) {
                return $response;
            }
    
            return view('mahasiswas.absensi', ['questionnaire' => $response->getData()['questionnaire']]);
        }
        
        if ($page === 'resume') {
            $suratKeterangan = ftw_tr_suratKeterangan::all();
            return view('mahasiswas.resume', compact('suratKeterangan'));
        }
        
        if (in_array($page, $validPages)) {
            return view('mahasiswas.' . $page);
        } else {
            abort(404); // Page not found
        }
    }
}
