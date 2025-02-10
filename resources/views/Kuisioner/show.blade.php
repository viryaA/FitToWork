@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>{{ $questionnaire->qur_title }}</h1>
    @if($questionnaire->qur_description)
        <p class="lead">{{ $questionnaire->qur_description }}</p>
    @endif

    <form action="{{ route('questionnaire.submit', $questionnaire->qur_id) }}" method="POST">
        @csrf
        @foreach($questionnaire->questions as $question)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $question->que_text }}
                        @if($question->que_required)
                            <span class="text-danger">*</span>
                        @endif
                    </h5>
                    <p class="text-muted">Points: {{ $question->que_points }}</p>

                    @if(in_array($question->que_type, ['Multiple Choice', 'Checkboxes', 'Dropdown', 'Radio Button']))
                        <!-- Options-based questions -->
                        @if($question->que_type === 'Dropdown')
                            <select name="answers[{{ $question->que_id }}]" 
                                    class="form-select"
                                    @if($question->que_required) required @endif>
                                <option value="">Select an option</option>
                                @foreach($question->options as $option)
                                    <option value="{{ $option->opt_id }}">{{ $option->opt_text }}</option>
                                @endforeach
                            </select>
                        @else
                            <div class="ms-3">
                                @foreach($question->options as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                            type="{{ $question->que_type === 'Checkboxes' ? 'checkbox' : 'radio' }}"
                                            name="answers[{{ $question->que_id }}]{{ $question->que_type === 'Checkboxes' ? '[]' : '' }}"
                                            id="option-{{ $option->opt_id }}"
                                            value="{{ $option->opt_id }}"
                                            @if($question->que_required) required @endif>
                                        <label class="form-check-label" for="option-{{ $option->opt_id }}">
                                            {{ $option->opt_text }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <!-- Text-based answers -->
                        <textarea name="answers[{{ $question->que_id }}]" 
                                  class="form-control" 
                                  rows="3"
                                  @if($question->que_required) required @endif></textarea>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">Submit Answers</button>
        </div>
    </form>
</div>
@endsection