<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ftw_ms_questionnaire;
use App\Models\ftw_ms_question;
use App\Models\ftw_ms_option;

class KuisionerController extends Controller
{
    /**
     * Show the form to create a new questionnaire.
     */
    public function create()
    {
        return view('Kuisioner.index');
    }

    /**
     * Store the form data (questionnaire and questions).
     */
    public function store(Request $request){
        try {
            // Step 1: Validate form title and description only
            $validatedData = $request->validate([
                'formTitle' => 'required|string|max:255',
                'formDescription' => 'nullable|string',
            ]);

            // Create the questionnaire
            $questionnaire = ftw_ms_questionnaire::create([
                'qur_title' => $validatedData['formTitle'],
                'qur_description' => $validatedData['formDescription'],
                'qur_created_by' => 'user',
            ]);
            Log::debug('Created questionnaire:', [$questionnaire]);

            // Step 2: Validate questions if they exist
            if (!empty($request->questions) && is_array($request->questions)) {
                foreach ($request->questions as $key => $questionText) {
                    // Validate individual questions
                    $request->validate([
                        "questions.{$key}" => 'required|string|max:255',
                        "points.{$key}" => 'required|integer|min:0',
                    ]);

                    // Ensure other required data exists
                    $answerType = $request->answerType[$key] ?? null;
                    if (!$answerType) {
                        throw new \Exception("Answer type missing for question index {$key}");
                    }

                    $question = ftw_ms_question::create([
                        'qur_id' => $questionnaire->qur_id,
                        'que_text' => $questionText,
                        'que_points' => $request->points[$key],
                        'que_type' => $answerType,
                        'que_required' => isset($request->required[$key]),
                    ]);
                    Log::debug('Created question:', [$question]);

                    // Handle options if present
                    if (in_array($answerType, ['Multiple Choice', 'Checkboxes', 'Dropdown', 'Radio Button']) && !empty($request->options[$key])) {
                        foreach ($request->options[$key] as $optionKey => $optionText) {
                            $request->validate([
                                "options.{$key}.{$optionKey}" => 'required|string|max:255',
                            ]);

                            $option = ftw_ms_option::create([
                                'que_id' => $question->que_id,
                                'opt_text' => $optionText,
                                'opt_is_correct' => isset($request->trueOption[$key][$optionKey]),
                            ]);
                            Log::debug('Created option:', [$option]);
                        }
                    }
                }
            }

            return redirect()->route('form.create')->with('success', 'Questionnaire created successfully!');
        } catch (\Exception $e) {
            Log::error('Error storing questionnaire:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'There was an error processing your request. Please try again.']);
        }
    }

}
