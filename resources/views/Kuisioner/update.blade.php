@extends('layouts.admin')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="bg-purple-600 text-white p-6 rounded-t-lg">
            <h1 class="text-2xl font-bold text-center">Update Your Form</h1>
        </div>
        <div class="bg-white p-6 rounded-b-lg shadow-lg">
            <form id="dynamicForm" action="{{ route('questionnaire.update', $questionnaire->qur_id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Use PUT for update requests -->

                <!-- Form Title -->
                <div class="mb-4">
                    <label for="formTitle" class="block text-gray-700 font-bold mb-2">Form Title</label>
                    <input type="text" id="formTitle" name="qur_title" 
                        value="{{ $questionnaire->qur_title }}" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        required>
                </div>

                <!-- Form Description -->
                <div class="mb-4">
                    <label for="formDescription" class="block text-gray-700 font-bold mb-2">Form Description</label>
                    <textarea id="formDescription" name="qur_description" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        rows="3" required>{{ $questionnaire->qur_description }}</textarea>
                </div>

                <!-- Questions Section -->
                <div id="questionsContainer">
                    @foreach ($questionnaire->questions as $index => $question)
                        <div class="mb-4 question-item flex items-center">
                            <div class="w-full">
                                <label class="block text-gray-700 font-bold mb-2" for="question{{ $index + 1 }}">
                                    Question {{ $index + 1 }}
                                </label>
                                <input type="text" id="question{{ $index + 1 }}" name="questions[{{ $index + 1 }}]" 
                                    value="{{ $question->que_text }}" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    required>
                                
                                <!-- Answer Type -->
                                <select id="answerType[{{ $index + 1 }}]" name="answerType[{{ $index + 1 }}]" 
                                    class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline answer-type-select">
                                    <option disabled>Select answer type</option>
                                    <option value="Short Answer" {{ $question->que_type == 'Short Answer' ? 'selected' : '' }}>Short Answer</option>
                                    <option value="Paragraph" {{ $question->que_type == 'Paragraph' ? 'selected' : '' }}>Paragraph</option>
                                    <option value="Multiple Choice" {{ $question->que_type == 'Multiple Choice' ? 'selected' : '' }}>Multiple Choice</option>
                                    <option value="Checkboxes" {{ $question->que_type == 'Checkboxes' ? 'selected' : '' }}>Checkboxes</option>
                                    <option value="Dropdown" {{ $question->que_type == 'Dropdown' ? 'selected' : '' }}>Dropdown</option>
                                    <option value="Radio Button" {{ $question->que_type == 'Radio Button' ? 'selected' : '' }}>Radio Button</option>
                                    <option value="Time" {{ $question->que_type == 'Time' ? 'selected' : '' }}>Time</option>
                                </select>

                                <!-- Points -->
                                <input type="number" id="points{{ $index + 1 }}" name="points[{{ $index + 1 }}]" 
                                    value="{{ $question->que_points }}" 
                                    class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    placeholder="Enter points" required>
                                
                                <!-- Required Checkbox -->
                                <div class="mt-2 flex items-center">
                                    <input type="checkbox" id="required{{ $index + 1 }}" name="required[{{ $index + 1 }}]" 
                                           class="form-checkbox" {{ $question->que_required ? 'checked' : '' }}>
                                    <label for="required{{ $index + 1 }}" class="ml-2 text-gray-700 font-bold">Required</label>
                                </div>

                                <!-- Options -->
                                <div class="mt-2 options-container" style="display: {{ in_array($question->que_type, ['Multiple Choice', 'Checkboxes', 'Dropdown', 'Radio Button']) ? 'block' : 'none' }}">
                                    <label class="block text-gray-700 font-bold mb-2">Options</label>
                                    <div class="options-wrapper">
                                        @foreach ($question->options as $optIndex => $option)
                                            <div class="flex items-center mt-2">
                                                <input type="text" name="options[{{ $index + 1 }}][{{ $optIndex }}]" 
                                                    value="{{ $option->opt_text }}" 
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                                    required>
                                                <input type="checkbox" name="correctOption[{{ $index + 1 }}][{{ $optIndex }}]" 
                                                    {{ $option->opt_is_correct ? 'checked' : '' }} 
                                                    class="ml-2 form-checkbox">
                                                <label class="ml-1 text-gray-700 font-bold">True</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="mt-2 bg-blue-500 text-white py-1 px-2 rounded add-option-btn">Add Option</button>
                                </div>
                            </div>
                            <button type="button" class="ml-4 text-red-500 hover:text-red-700 focus:outline-none focus:shadow-outline delete-question-btn">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    @endforeach
                </div>

                <!-- Add/Delete Buttons -->
                <div class="flex justify-end mt-4">
                    <button type="button" id="addQuestionBtn" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 focus:outline-none focus:shadow-outline">Add Question</button>
                    <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded ml-2 hover:bg-purple-800 focus:outline-none focus:shadow-outline">Update Form</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('addQuestionBtn').addEventListener('click', function() {
        const questionsContainer = document.getElementById('questionsContainer');
        const questionCount = questionsContainer.children.length + 1;

        const questionItem = document.createElement('div');
        questionItem.classList.add('mb-4', 'question-item', 'flex', 'items-center');

        const questionContent = document.createElement('div');
        questionContent.classList.add('w-full');

        const questionLabel = document.createElement('label');
        questionLabel.classList.add('block', 'text-gray-700', 'font-bold', 'mb-2');
        questionLabel.setAttribute('for', `question${questionCount}`);
        questionLabel.textContent = `Question ${questionCount}`;

        const questionInput = document.createElement('input');
        questionInput.type = 'text';
        questionInput.id = `question${questionCount}`;
        questionInput.name = `questions[${questionCount}]`;
        questionInput.classList.add('shadow', 'appearance-none', 'border', 'rounded', 'w-full', 'py-2', 'px-3', 'text-gray-700', 'leading-tight', 'focus:outline-none', 'focus:shadow-outline');
        questionInput.placeholder = 'Enter your question';
        questionInput.required = true;

        const answerTypeSelect = document.createElement('select');
        answerTypeSelect.id = `answerType[${questionCount}]`;
        answerTypeSelect.name = `answerType[${questionCount}]`;
        answerTypeSelect.classList.add('mt-2', 'shadow', 'appearance-none', 'border', 'rounded', 'w-full', 'py-2', 'px-3', 'text-gray-700', 'leading-tight', 'focus:outline-none', 'focus:shadow-outline', 'answer-type-select');
        answerTypeSelect.innerHTML = `
            <option disabled selected>Select answer type</option>
            <option value="Short Answer">Short Answer</option>
            <option value="Paragraph">Paragraph</option>
            <option value="Multiple Choice">Multiple Choice</option>
            <option value="Checkboxes">Checkboxes</option>
            <option value="Dropdown">Dropdown</option>
            <option value="Radio Button">Radio Button</option>
            <option value="Time">Time</option>
        `;

        const pointsInput = document.createElement('input');
        pointsInput.type = 'number';
        pointsInput.id = `points${questionCount}`;
        pointsInput.name = `points[${questionCount}]`;
        pointsInput.classList.add('mt-2', 'shadow', 'appearance-none', 'border', 'rounded', 'w-full', 'py-2', 'px-3', 'text-gray-700', 'leading-tight', 'focus:outline-none', 'focus:shadow-outline');
        pointsInput.placeholder = 'Enter points';
        pointsInput.required = true;

        const requiredCheckboxWrapper = document.createElement('div');
        requiredCheckboxWrapper.classList.add('mt-2', 'flex', 'items-center');
        const requiredLabel = document.createElement('label');
        requiredLabel.classList.add('text-gray-700', 'font-bold', 'mr-2');
        requiredLabel.textContent = 'Required:';
        const requiredCheckbox = document.createElement('input');
        requiredCheckbox.type = 'checkbox';
        requiredCheckbox.name = `required[${questionCount}]`;
        requiredCheckbox.classList.add('ml-2', 'form-checkbox');

        requiredCheckboxWrapper.appendChild(requiredLabel);
        requiredCheckboxWrapper.appendChild(requiredCheckbox);

        questionContent.appendChild(questionLabel);
        questionContent.appendChild(questionInput);
        questionContent.appendChild(answerTypeSelect);
        questionContent.appendChild(pointsInput);
        questionContent.appendChild(requiredCheckboxWrapper);

        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.classList.add('ml-4', 'text-red-500', 'hover:text-red-700', 'focus:outline-none', 'focus:shadow-outline', 'delete-question-btn');
        deleteButton.innerHTML = `<i class="fas fa-trash-alt"></i>`;

        questionItem.appendChild(questionContent);
        questionItem.appendChild(deleteButton);
        questionsContainer.appendChild(questionItem);

        // Handle question delete
        deleteButton.addEventListener('click', function() {
            questionsContainer.removeChild(questionItem);
        });
    });

    document.querySelectorAll('.answer-type-select').forEach(select => {
        select.addEventListener('change', function() {
            const optionsContainer = this.closest('.question-item').querySelector('.options-container');
            if (['Multiple Choice', 'Checkboxes', 'Dropdown', 'Radio Button'].includes(this.value)) {
                optionsContainer.style.display = 'block';
            } else {
                optionsContainer.style.display = 'none';
            }
        });
    });
</script>
@endsection
