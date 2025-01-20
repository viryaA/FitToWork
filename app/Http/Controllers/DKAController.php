<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DKAController extends Controller
{
    public function show($page)
    {
        // Check if the view exists to prevent errors
        $validPages = ['absensi', 'beranda', 'index','resume', 'rekap', 'laporanMhs', 'laporanKry'];  // Add your valid pages here

        if (in_array($page, $validPages)) {
            return view('dkas.' . $page);
        } else {
            abort(404); // Page not found
        }
    }
}
