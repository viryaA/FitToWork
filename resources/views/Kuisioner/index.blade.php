@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Questionnaires</h1>

    <!-- Add Questionnaire Button -->
    <div class="mb-3">
        <a href="{{ route('questionnaire.create') }}" class="btn btn-primary">
            Add Questionnaire
        </a>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created By</th>
                <th>Questions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($questionnaires as $questionnaire)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $questionnaire->qur_title }}</td>
                    <td>{{ $questionnaire->qur_description }}</td>
                    <td>{{ $questionnaire->qur_created_by }}</td>
                    <td>
                        @if ($questionnaire->questions->isNotEmpty())
                            <button class="btn btn-info btn-sm" data-bs-toggle="collapse" data-bs-target="#questions-{{ $questionnaire->qur_id }}">
                                View Questions
                            </button>

                            <!-- Collapsible Questions -->
                            <div id="questions-{{ $questionnaire->qur_id }}" class="collapse mt-2">
                                <ul class="list-group">
                                    @foreach ($questionnaire->questions as $question)
                                        <li class="list-group-item">
                                            <strong>Q{{ $loop->iteration }}:</strong> {{ $question->que_text }} ({{ $question->que_type }})
                                            @if ($question->options->isNotEmpty())
                                                <ul class="mt-2">
                                                    @foreach ($question->options as $option)
                                                        <li>
                                                            {{ $option->opt_text }}
                                                            @if ($option->opt_is_correct)
                                                                <span class="badge bg-success">Correct</span>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <span class="text-muted">No Questions</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('questionnaire.edit', $questionnaire->qur_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('questionnaire.destroy', $questionnaire->qur_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this questionnaire?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No Questionnaires Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
