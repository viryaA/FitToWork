<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\KuisionerController;
use App\Models\ftw_tr_response;
use App\Models\ftw_ms_questionnaire;
// use Illuminate\Http\Request;
class AdminController extends Controller
{


    public function show($page)
    {
        // Check if the view exists to prevent errors
        $validPages = ['beranda','questionnaire']; 
        
        if($page === "questionnaire"){
            $questionnaires = ftw_ms_questionnaire::with(['questions.options'])->get();
            return view('Kuisioner.index', compact('questionnaires'));
        }
        if (!in_array($page, $validPages)) {
            abort(404); // Page not found
        }
    
        // Load other static views normally
        return view('admin.' . $page);
    }
}




