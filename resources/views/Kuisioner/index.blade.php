@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Questionnaires</h1>

    <!-- Add Questionnaire Button -->
    <div class="mb-4">
        <a href="{{ route('questionnaire.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Add Questionnaire
        </a>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto">
        
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">#</th>
                    <th class="border p-2">Title</th>
                    <th class="border p-2">Description</th>
                    <th class="border p-2">Questions</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($questionnaires as $questionnaire)
                    <tr class="border">
                        <td class="border p-2">{{ $loop->iteration }}</td>
                        <td class="border p-2">{{ $questionnaire->qur_title }}</td>
                        <td class="border p-2">{{ $questionnaire->qur_description }}</td>
                        <td class="border p-2">
                            @if ($questionnaire->questions->isNotEmpty())
                                <button class="bg-blue-500 text-white px-3 py-1 rounded text-sm" onclick="toggleCollapse('questions-{{ $questionnaire->qur_id }}')">
                                    View Questions
                                </button>
                                <!-- Collapsible Questions -->
                                <div id="questions-{{ $questionnaire->qur_id }}" class="hidden mt-2">
                                    <ul class="list-none bg-gray-100 p-2 rounded">
                                        @foreach ($questionnaire->questions as $question)
                                            <li class="border-b py-2">
                                                <strong>Q{{ $loop->iteration }}:</strong> {{ $question->que_text }} ({{ $question->que_type }})
                                                @if ($question->options->isNotEmpty())
                                                    <ul class="mt-1 ml-4 list-disc">
                                                        @foreach ($question->options as $option)
                                                            <li>
                                                                {{ $option->opt_text }}
                                                                @if ($option->opt_is_correct)
                                                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Correct</span>
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
                                <span class="text-gray-500">No Questions</span>
                            @endif
                        </td>
                        <td class="border p-2 flex space-x-2">
                            <a href="{{ route('questionnaire.edit', $questionnaire->qur_id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit</a>
                            <form action="{{ route('questionnaire.destroy', $questionnaire->qur_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this questionnaire?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4">No Questionnaires Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleCollapse(id) {
        var element = document.getElementById(id);
        element.classList.toggle('hidden');
    }
</script>
@endsection