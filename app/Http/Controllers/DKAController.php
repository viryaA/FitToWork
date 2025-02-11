<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\KuisionerController;
use App\Models\ftw_tr_response;
// use Illuminate\Http\Request;
class DKAController extends Controller
{
    // public function show($page)
    // {
    //     // Check if the view exists to prevent errors
    //     $validPages = ['absensi', 'beranda', 'index','resume', 'rekap', 'laporan_kecelakaan'];  // Add your valid pages here

    //     if (in_array($page, $validPages)) {
    //         return view('dkas.' . $page);
    //     } else {
    //         abort(404); // Page not found
    //     }
    // }

    public function show($page)
    {
        // Check if the view exists to prevent errors
        $validPages = ['absensi', 'beranda', 'index','resume', 'rekap', 'laporanMhs', 'laporanKry']; 
        
        if (!in_array($page, $validPages)) {
            abort(404); // Page not found
        }
    
        // If the page is 'form', get questionnaire data
        if ($page === 'absensi') {
            $kuisionerController = new KuisionerController();
            $response = $kuisionerController->show(1);
    
            // Check if the response is a redirect (error handling)
            if ($response instanceof \Illuminate\Http\RedirectResponse) {
                return $response;
            }
    
            return view('dkas.absensi', ['questionnaire' => $response->getData()['questionnaire']]);
        }

        if ($page === 'rekap') {
            $responses = ftw_tr_response::all();
            return view('dkas.rekap', ['responses' => $responses]);
        }
    
        // Load other static views normally
        return view('dkas.' . $page);
    }
}




