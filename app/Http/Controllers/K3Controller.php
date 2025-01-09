<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class K3Controller extends Controller
{
    public function show($page)
    {
        // Check if the view exists to prevent errors
        $validPages = ['absensi', 'beranda', 'index','resume', 'rekap', 'laporan_kecelakaan'];  // Add your valid pages here

        if (in_array($page, $validPages)) {
            return view('k3s.' . $page);
        } else {
            abort(404); // Page not found
        }
    }
}
