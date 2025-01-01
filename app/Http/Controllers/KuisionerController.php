<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    public function showForm()
    {
        return view('Kuisioner.index');
    }

    public function saveForm(Request $request)
    {
        $formData = $request->all();

        // Process the form data (save to the database, etc.)
        // Example: Log the data to confirm it's being received correctly.
        \Log::info($formData);

        return back()->with('success', 'Form saved successfully!');
    }
}
