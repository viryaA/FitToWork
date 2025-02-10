<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\KuisionerController;
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
        $validPages = ['absensi', 'beranda', 'index', 'resume', 'rekap', 'laporan_kecelakaan']; 
    
        if (!in_array($page, $validPages)) {
            abort(404); // Page not found
        }
    
        // If the page is 'form', get questionnaire data
        if ($page === 'absensi') {
            $kuisionerController = new KuisionerController();
            $response = $kuisionerController->show(7);
    
            // Check if the response is a redirect (error handling)
            if ($response instanceof \Illuminate\Http\RedirectResponse) {
                return $response;
            }
    
            return view('dkas.absensi', ['questionnaire' => $response->getData()['questionnaire']]);
        }
    
        // Load other static views normally
        return view('dkas.' . $page);
    }
}




