<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ftw_ms_questionnaire;
use App\Models\ftw_tr_response;
use App\Models\ftw_tr_answer;
use App\Models\ftw_ms_question;
use App\Models\ftw_ms_option;
use Illuminate\Support\Facades\DB;


class KuisionerController extends Controller
{
    public function index()
    {
        $questionnaires = ftw_ms_questionnaire::with(['questions.options'])->get();
        return view('Kuisioner.index', compact('questionnaires'));
    }
    /**
     * Show the form to create a new questionnaire.
     */
    public function create()
    {
        return view('Kuisioner.create');
    }
    public function edit($id)
    {
        
        $questionnaire = ftw_ms_questionnaire::with('questions.options')->findOrFail($id);
        Log::debug('Update method called with ID:', ['id' => $questionnaire ]);
        return view('Kuisioner.update', compact('questionnaire'));
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
                                'opt_is_correct' => isset($request->correctOption[$key][$optionKey]),
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

    public function update(Request $request, $id)
    {
        $data = $request->all(); // Validate this appropriately
        Log::debug(['Received data:' => $data]);

        // Begin database transaction
        DB::beginTransaction();

        try {
            // Update the Questionnaire
            $questionnaire = ftw_ms_questionnaire::findOrFail($id);
            $questionnaire->update([
                'qur_title' => $data['formTitle'],
                'qur_description' => $data['formDescription'],
                'qur_created_by' => 'Admin', // Hardcoded for now, adjust as needed
            ]);

            // Update or Create Questions
            foreach ($data['questionID'] as $index => $questionId) {
                $required = isset($data['required'][$index]) ? 1 : 0;
                $points = $data['points'][$index] ?? 0;

                // Update or create question
                $question = ftw_ms_question::updateOrCreate(
                    ['que_id' => $questionId], // Match by ID for existing questions
                    [
                        'qur_id' => $id,
                        'que_text' => $data['questions'][$index] ?? '',
                        'que_type' => $data['answerType'][$index] ?? 'Short Answer',
                        'que_required' => $required,
                        'que_points' => $points,
                    ]
                );
                Log::debug('Question Updated:', [$question]);

                // Handle question options if applicable
                if (isset($data['options'][$index])) {
                    foreach ($data['options'][$index] as $optionIndex => $optionText) {
                        ftw_ms_option::updateOrCreate(
                            ['opt_id' => $data['optionsID'][$index][$optionIndex] ?? null], // Match by ID if provided
                            [
                                'que_id' => $question->que_id,
                                'opt_text' => $optionText,
                                'opt_is_correct' => isset($data['correctOption'][$index][$optionIndex]) ? 1 : 0,
                            ]
                        );
                    }
                }

                // Handle deleted options
                if (isset($data['deleteOption'][$index])) {
                    foreach ($data['deleteOption'][$index] as $optionIndex => $deleteFlag) {
                        if ($deleteFlag == 1 && isset($data['optionsID'][$index][$optionIndex])) {
                            ftw_ms_option::where('opt_id', $data['optionsID'][$index][$optionIndex])->delete();
                        }
                    }
                }
            }

            // Handle deleted questions
            if (isset($data['deleteQuestion'])) {
                foreach ($data['deleteQuestion'] as $questionIndex => $deleteFlag) {
                    if ($deleteFlag == 1 && isset($data['questionID'][$questionIndex])) {
                        ftw_ms_question::where('que_id', $data['questionID'][$questionIndex])->delete();
                    }
                }
            }

            // Commit transaction
            DB::commit();

            try {
                $questionnaire = ftw_ms_questionnaire::with(['questions' => function($query) {
                    $query->with('options')->orderBy('que_id');
                }])->findOrFail($id);
    
                return view('Kuisioner.show', compact('questionnaire'));
            } catch (\Exception $e) {
                Log::error('Error loading questionnaire:', ['error' => $e->getMessage()]);
                return redirect()->back()->withErrors(['error' => 'Questionnaire not found']);
            }
        } catch (\Exception $e) {
            // Rollback transaction in case of an error
            DB::rollBack();
            Log::error('Error updating questionnaire:', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 500);
        }
        return redirect()->back()->withErrors(['error' => 'Questionnaire not found']);
    }

    public function show($id)
    {
        try {
            $questionnaire = ftw_ms_questionnaire::with(['questions' => function($query) {
                $query->with('options')->orderBy('que_id');
            }])->findOrFail($id);

            return view('Kuisioner.show', compact('questionnaire'));
        } catch (\Exception $e) {
            Log::error('Error loading questionnaire:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Questionnaire not found']);
        }
    }

    public function submit(Request $request, $id)
    {
        try {
            $questionnaire = ftw_ms_questionnaire::with('questions')->findOrFail($id);

            // Validation rules setup
            $validationRules = [];
            foreach ($questionnaire->questions as $question) {
                if ($question->que_required) {
                    $validationRules["answers.{$question->que_id}"] = 'required';
                }
            }

            $validated = $request->validate($validationRules);

            // Save the response first
            $response = ftw_tr_response::create([
                'qur_id' => $id,
                'res_responder_id' => auth()->id() ?? null, // If using authentication
            ]);

            // Store the answers
            foreach ($request->answers as $questionId => $answer) {
                $question = ftw_ms_question::find($questionId);
                $que_points = $question ? $question->que_points : 0; // Ensure que_points is fetched

                if (is_array($answer)) {
                    foreach ($answer as $data) {
                        $option = ftw_ms_option::find($data);
                        $opt_is_correct = $option ? $option->opt_is_correct : 0;
                        $points_earned = $opt_is_correct ? $que_points : 0; // Earn points only if correct

                        ftw_tr_answer::create([
                            'que_id' => $questionId,
                            'res_id' => $response->id, // Link answers to the response
                            'opt_id' => $data,
                            'ans_text' => null,
                            'ans_points_earned' => $points_earned, // Store earned points
                        ]);
                    }
                } else {
                    ftw_tr_answer::create([
                        'que_id' => $questionId,
                        'res_id' => $response->id, // Link answers to the response
                        'opt_id' => null,
                        'ans_text' => $answer,
                        'ans_points_earned' => 0, // Default to 0 for non-multiple-choice
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Answers submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Error submitting answers:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Error submitting answers']);
        }
    }



    // public function submit(Request $request, $id)
    // {
    //     try {

    //         $response = ftw_tr_response::findOrFail($request->res_id);
    //         $questionnaire = ftw_ms_questionnaire::with('questions.options')->findOrFail($id);

    //         $totalScore = 0;
    //         $answers = [];

    //         foreach ($questionnaire->questions as $question) {
    //             $answerKey = "answers.{$question->que_id}";
                
    //             // Validation rules
    //             $rules = [];
    //             if ($question->que_required) {
    //                 $rules[$answerKey] = 'required';
    //             }

    //             // Special handling for checkboxes (array)
    //             if ($question->que_type === 'Checkboxes') {
    //                 $rules["{$answerKey}.*"] = 'exists:ftw_ms_options,opt_id';
    //             }

    //             $request->validate($rules);

    //             // Process answers
    //             $answerValues = $request->input($answerKey);
                
    //             if ($question->que_type === 'Checkboxes') {
    //                 foreach ((array)$answerValues as $optId) {
    //                     $answers[] = $this->createAnswer($response->res_id, $question, $optId);
    //                     $totalScore += $this->calculatePoints($question, $optId);
    //                 }
    //             } else {
    //                 $answers[] = $this->createAnswer($response->res_id, $question, $answerValues);
    //                 $totalScore += $this->calculatePoints($question, $answerValues);
    //             }
    //         }

    //         // Update response with total score
    //         $response->update([
    //             'total_score' => $totalScore,
    //             'submitted_at' => now()
    //         ]);

    //         // Bulk insert answers
    //         ftw_tr_answer::insert($answers);

    //         return redirect()->back()->with('success', 'Answers submitted successfully! Score: '.$totalScore);

    //     } catch (\Exception $e) {
    //         Log::error('Error submitting answers:', ['error' => $e->getMessage()]);
    //         return redirect()->back()->withErrors(['error' => 'Error submitting answers: '.$e->getMessage()]);
    //     }
    // }

    private function createAnswer($resId, $question, $value)
    {
        $answer = [
            'res_id' => $resId,
            'que_id' => $question->que_id,
            'created_at' => now(),
            'updated_at' => now()
        ];

        if (in_array($question->que_type, ['Multiple Choice', 'Checkboxes', 'Dropdown', 'Radio Button'])) {
            $answer['opt_id'] = $value;
        } else {
            $answer['ans_text'] = $value;
        }

        return $answer;
    }

    private function calculatePoints($question, $value)
    {
        if (!is_numeric($value) && !$question->options->count()) {
            return $question->que_points;
        }

        $option = ftw_ms_option::find($value);
        return $option && $option->opt_is_correct ? $question->que_points : 0;
    }

}
