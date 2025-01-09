<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UKKController extends Controller
{
    public function show($page)
    {
        // Check if the view exists to prevent errors
        $validPages = ['absensi', 'beranda', 'index','resume_mahasiswa', 'resume_karyawan', 'rekap'];  // Add your valid pages here

        if (in_array($page, $validPages)) {
            return view('ukks.' . $page);
        } else {
            abort(404); // Page not found
        }
    }
}
