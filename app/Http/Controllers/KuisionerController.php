<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ftw_ms_questionnaire;
use App\Models\Question;
use App\Models\Option;

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
    public function store(Request $request)
    {
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
            ]);
            Log::debug('Created questionnaire:', [$questionnaire]);

            // Step 2: Validate questions if they exist
            if (isset($request->questions) && count($request->questions) > 0) {
                $request->validate([
                    'questions' => 'required|array|min:1', // Ensure at least one question is present
                    'questions.*.question_text' => 'required|string', // Each question must have text
                    'questions.*.answer_type' => 'required|integer', // Each question must have a valid answer type
                    'questions.*.points' => 'required|integer', // Points for the question are required
                    'questions.*.required' => 'required|boolean', // Required status of the question
                ]);

                // Loop through questions and save them
                foreach ($request->questions as $questionData) {
                    // Create the question
                    $question = Question::create([
                        'qur_id' => $questionnaire->qur_id,
                        'que_text' => $questionData['question_text'],
                        'que_type' => $questionData['answer_type'],
                        'que_required' => $questionData['required'],
                        'que_points' => $questionData['points'],
                    ]);
                    Log::debug('Created question:', [$question]);

                    // Step 3: Validate options if they exist for each question
                    if (isset($questionData['options']) && count($questionData['options']) > 0) {
                        $request->validate([
                            'questions.*.options' => 'array',
                            'questions.*.options.*.option_text' => 'required_with:questions.*.options|string', // If options are provided, each must have text
                            'questions.*.options.*.is_correct' => 'required_with:questions.*.options|boolean', // If options are provided, each must have a boolean flag for correctness
                        ]);

                        // Loop through options and save them
                        foreach ($questionData['options'] as $optionData) {
                            // Create the option
                            $option = Option::create([
                                'que_id' => $question->que_id,
                                'opt_text' => $optionData['option_text'],
                                'opt_is_correct' => $optionData['is_correct'],
                            ]);
                            Log::debug('Created option:', [$option]);
                        }
                    }
                }
            }

            // Redirect back with success message
            return redirect()->route('form.create')->with('success', 'Form saved successfully.');
        } catch (\Exception $e) {
            // Log the error and redirect back with an error message
            Log::error('Error saving form:', ['exception' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
