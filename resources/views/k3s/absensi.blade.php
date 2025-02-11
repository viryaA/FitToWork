@extends('layouts.dka')
@section('title', 'Form Absensi Kesehatan')

@section('style')
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
        }
        .subheader {
            font-size: 1.5rem;
            font-weight: bold;
            color: #000;
        }
        .divider {
            border-top: 1px solid #dee2e6;
            margin: 0.5rem 0 1rem;
        }
    </style>
@endsection

@section('content')
<div class="content">
    <div class="d-flex align-items-center">
        <span class="header">Fit to Work</span>
        <span class="mx-2">/</span>
        <span class="subheader">Kesehatan</span>
        <span class="mx-2">/</span>
        <span class="subheader">Absensi</span>
    </div>
    <div class="divider"></div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i><strong>{{ $questionnaire->qur_title }}</strong></i>
        </div>
        <div class="card-body">
            <i><strong>{{ $questionnaire->qur_description }}</strong></i>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">

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
                            @if($question->que_type === 'Dropdown')
                                <select name="answers[{{ $question->que_id }}]" class="form-select" @if($question->que_required) required @endif>
                                    <option value="">Select an option</option>
                                    @foreach($question->options as $option)
                                        <option value="{{ $option->opt_id }}">{{ $option->opt_text }}</option>
                                    @endforeach
                                </select>
                            @else
                                <div class="ms-3">
                                    @foreach($question->options as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="{{ $question->que_type === 'Checkboxes' ? 'checkbox' : 'radio' }}" 
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
                        @elseif($question->que_type === 'Short Answer')
                            <input type="text" name="answers[{{ $question->que_id }}]" class="form-control" @if($question->que_required) required @endif>
                        @elseif($question->que_type === 'Paragraph')
                            <textarea name="answers[{{ $question->que_id }}]" class="form-control" rows="3" @if($question->que_required) required @endif></textarea>
                        @elseif($question->que_type === 'Time')
                            <input type="time" name="answers[{{ $question->que_id }}]" class="form-control" @if($question->que_required) required @endif>
                        @endif
                    </div>
                </div>
                @endforeach

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Submit Answers</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleTextarea(show) {
        document.getElementById('textareaWrapper').style.display = show ? 'block' : 'none';
    }
</script>
@endsection
