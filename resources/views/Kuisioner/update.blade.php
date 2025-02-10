@extends('layouts.admin')
@section('content')
    <div class="container mx-auto mt-10">
        <div class="bg-blue-600 text-white p-6 rounded-t-lg">
            <h1 class="text-2xl font-bold text-center">Edit Your Form</h1>
        </div>
        <div class="bg-white p-6 rounded-b-lg shadow-lg">
            <form id="dynamicForm" action="{{ route('questionnaire.update', $questionnaire->qur_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="formTitle" class="block text-gray-700 font-bold mb-2">Form Title</label>
                    <input type="hidden" name="questionnaireID" value="{{ $questionnaire->qur_id }}">
                    <input type="text" id="formTitle" name="formTitle" value="{{ $questionnaire->qur_title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="formDescription" class="block text-gray-700 font-bold mb-2">Form Description</label>
                    <textarea id="formDescription" name="formDescription" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3" required>{{ $questionnaire->qur_description }}</textarea>
                </div>

                <div id="questionsContainer">
                @foreach ($questionnaire->questions as $index => $question)
                    <div class="mb-4 question-item flex items-center relative">
                        <div class="w-full">
                            <label for="question{{ $index + 1 }}" class="block text-gray-700 font-bold mb-2">Question {{ $index + 1 }}</label>
                            <input type="hidden" name="questionID[{{ $index + 1 }}]" value="{{ $question->que_id }}">
                            <input type="hidden" name="deleteQuestion[{{ $index + 1 }}]" value="0" class="delete-question-flag">
                            <input type="text" id="question{{ $index + 1 }}" name="questions[{{ $index + 1 }}]" value="{{ $question->que_text }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>

                            <select id="answerType[{{ $index + 1 }}]" name="answerType[{{ $index + 1 }}]" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline answer-type-select" required>
                                <option disabled>Select answer type</option>
                                <option value="Short Answer" {{ $question->que_type == 'Short Answer' ? 'selected' : '' }}>Short Answer</option>
                                <option value="Paragraph" {{ $question->que_type == 'Paragraph' ? 'selected' : '' }}>Paragraph</option>
                                <option value="Multiple Choice" {{ $question->que_type == 'Multiple Choice' ? 'selected' : '' }}>Multiple Choice</option>
                                <option value="Checkboxes" {{ $question->que_type == 'Checkboxes' ? 'selected' : '' }}>Checkboxes</option>
                                <option value="Dropdown" {{ $question->que_type == 'Dropdown' ? 'selected' : '' }}>Dropdown</option>
                                <option value="Radio Button" {{ $question->que_type == 'Radio Button' ? 'selected' : '' }}>Radio Button</option>
                                <option value="Time" {{ $question->que_type == 'Time' ? 'selected' : '' }}>Time</option>
                            </select>

                            <input type="number" id="points{{ $index + 1 }}" name="points[{{ $index + 1 }}]" value="{{ $question->que_points }}" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>

                            <div class="mt-2 flex items-center">
                                <label class="text-gray-700 font-bold mr-2">Required</label>
                                <input type="checkbox" id="required{{ $index + 1 }}" name="required[{{ $index + 1 }}]" class="form-checkbox" {{ $question->que_required ? 'checked' : '' }}>
                            </div>
                            @if (in_array($question->que_type, ['Multiple Choice', 'Checkboxes', 'Dropdown', 'Radio Button']))
                            <div id="options-wrapper-{{  $index + 1 }}">
                                    @if (count($question->options) > 0)
                                        <!-- Render existing options -->
                                        @foreach ($question->options as $optIndex => $option)
                                            <div class="flex items-center mt-2 option-item">
                                                <input type="hidden" name="optionsID[{{  $index + 1 }}][{{ $optIndex }}]" value="{{ $option->opt_id }}">
                                                <input type="text" name="options[{{  $index + 1 }}][{{ $optIndex }}]" value="{{ $option->opt_text }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                                <input type="checkbox" name="correctOption[{{  $index + 1 }}][{{ $optIndex }}]" class="ml-2 form-checkbox" {{ $option->opt_is_correct ? 'checked' : '' }}>
                                                <label class="ml-1 text-gray-700 font-bold">True</label>
                                                <button type="button" class="ml-2 text-red-500 hover:text-red-700 focus:outline-none focus:shadow-outline delete-option-btn">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- Add Option Button -->
                                <button id="add-option-btn-{{  $index + 1 }}" type="button" class="mt-2 bg-blue-500 text-white py-1 px-2 rounded">
                                    Add Option
                                </button>

                            @endif
                        </div>
                        <button type="button" class="absolute top-0 right-0 text-red-500 font-bold delete-question-btn"><i class="fas fa-trash-alt"></i></button>
                    </div>
                @endforeach


                </div>

                <div class="flex justify-end mt-4">
                    <button type="button" id="addQuestionBtn" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 focus:outline-none focus:shadow-outline">Add Question</button>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded ml-2 hover:bg-blue-800 focus:outline-none focus:shadow-outline">Update Form</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('[id^="add-option-btn-"]').forEach((addOptionBtn) => {
    addOptionBtn.addEventListener('click', function () {
        const questionCount = this.id.split('-').pop(); // Extract question count from button ID
        const optionsWrapper = document.querySelector(`#options-wrapper-${questionCount}`);

        const optionWrapper = document.createElement('div');
        optionWrapper.classList.add('flex', 'items-center', 'mt-2', 'option-item');

        const optionIndex = optionsWrapper.children.length;

        const optionID = document.createElement('input');
        optionID.type = 'hidden';
        optionID.name = `optionsID[${questionCount}][${optionIndex}]`;

        const optionInput = document.createElement('input');
        optionInput.type = 'text';
        optionInput.name = `options[${questionCount}][${optionIndex}]`;
        optionInput.classList.add(
            'shadow',
            'appearance-none',
            'border',
            'rounded',
            'w-full',
            'py-2',
            'px-3',
            'text-gray-700',
            'leading-tight',
            'focus:outline-none',
            'focus:shadow-outline'
        );
        optionInput.placeholder = 'Enter option';
        optionInput.required = true;

        const trueOptionCheckbox = document.createElement('input');
        trueOptionCheckbox.type = 'checkbox';
        trueOptionCheckbox.name = `correctOption[${questionCount}][${optionIndex}]`;
        trueOptionCheckbox.classList.add('ml-2', 'form-checkbox');

        const trueOptionLabel = document.createElement('label');
        trueOptionLabel.classList.add('ml-1', 'text-gray-700', 'font-bold');
        trueOptionLabel.textContent = 'True';

        const deleteOptionBtn = document.createElement('button');
        deleteOptionBtn.type = 'button';
        deleteOptionBtn.classList.add('ml-2', 'text-red-500', 'hover:text-red-700', 'focus:outline-none', 'focus:shadow-outline');
        deleteOptionBtn.innerHTML = '<i class="fas fa-trash-alt"></i>';

        deleteOptionBtn.addEventListener('click', function () {
            optionsWrapper.removeChild(optionWrapper);
        });

        optionWrapper.appendChild(optionID);
        optionWrapper.appendChild(optionInput);
        optionWrapper.appendChild(trueOptionCheckbox);
        optionWrapper.appendChild(trueOptionLabel);
        optionWrapper.appendChild(deleteOptionBtn);

        optionsWrapper.appendChild(optionWrapper);
    });
});

    document.querySelectorAll(".delete-question-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const questionItem = this.closest(".question-item");
            const deleteFlag = questionItem.querySelector(".delete-question-flag");
            deleteFlag.value = "1"; // Mark the question for deletion
            questionItem.style.display = "none"; // Hide the question
        });
    });

    // Handle option deletion
    document.querySelectorAll(".delete-option-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const optionItem = this.closest(".flex.items-center");
            const deleteFlag = optionItem.querySelector(".delete-option-flag");
            deleteFlag.value = "1"; // Mark the option for deletion
            optionItem.style.display = "none"; // Hide the option
        });
    });

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

    const queID = document.createElement('input');
    queID.type = 'hidden';
    queID.id = `questionID${questionCount}`;
    queID.name = `questionID[${questionCount}]`;
    queID.value = 0;

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
    requiredLabel.textContent = 'Required';
    const requiredCheckbox = document.createElement('input');
    requiredCheckbox.type = 'checkbox';
    requiredCheckbox.id = `required${questionCount}`;
    requiredCheckbox.name = `required[${questionCount}]`;
    requiredCheckbox.classList.add('form-checkbox');
    requiredCheckboxWrapper.appendChild(requiredLabel);
    requiredCheckboxWrapper.appendChild(requiredCheckbox);

    // Options container (hidden initially)
    const optionsContainer = document.createElement('div');
    optionsContainer.classList.add('mt-2', 'options-container');
    optionsContainer.style.display = 'none'; // Hidden by default

    const optionsLabel = document.createElement('label');
    optionsLabel.classList.add('block', 'text-gray-700', 'font-bold', 'mb-2');
    optionsLabel.textContent = 'Enter options (each in a separate input field)';

    const optionsWrapper = document.createElement('div');
    optionsWrapper.classList.add('options-wrapper');

    const addOptionBtn = document.createElement('button');
    addOptionBtn.type = 'button';
    addOptionBtn.classList.add('mt-2', 'bg-blue-500', 'text-white', 'py-1', 'px-2', 'rounded');
    addOptionBtn.textContent = 'Add Option';
    optionsWrapper.appendChild(addOptionBtn);

    addOptionBtn.addEventListener('click', function() {
        const optionWrapper = document.createElement('div');
        optionWrapper.classList.add('flex', 'items-center', 'mt-2');

        const optionIndex = optionsWrapper.children.length;

        const optionID = document.createElement('input');
        optionID.type = 'hidden';
        optionID.name = `optionsID[${questionCount}][${optionIndex}]`; // Assign name attribute

        const optionInput = document.createElement('input');
        optionInput.type = 'text';
        optionInput.name = `options[${questionCount}][${optionIndex}]`; // Assign name attribute
        optionInput.classList.add('shadow', 'appearance-none', 'border', 'rounded', 'w-full', 'py-2', 'px-3', 'text-gray-700', 'leading-tight', 'focus:outline-none', 'focus:shadow-outline');
        optionInput.placeholder = 'Enter option';
        optionInput.required = true;

        const trueOptionCheckbox = document.createElement('input');
        trueOptionCheckbox.type = 'checkbox';
        trueOptionCheckbox.name = `correctOption[${questionCount}][${optionIndex}]`; // Assign name attribute for "true" checkbox
        trueOptionCheckbox.classList.add('ml-2', 'form-checkbox');

        const trueOptionLabel = document.createElement('label');
        trueOptionLabel.classList.add('ml-1', 'text-gray-700', 'font-bold');
        trueOptionLabel.textContent = 'True';

        const deleteOptionBtn = document.createElement('button');
        deleteOptionBtn.type = 'button';
        deleteOptionBtn.classList.add('ml-2', 'text-red-500', 'hover:text-red-700', 'focus:outline-none', 'focus:shadow-outline');
        deleteOptionBtn.innerHTML = '<i class="fas fa-trash-alt"></i>';

        optionWrapper.appendChild(optionID);
        optionWrapper.appendChild(optionInput);
        optionWrapper.appendChild(trueOptionCheckbox);
        optionWrapper.appendChild(trueOptionLabel);
        optionWrapper.appendChild(deleteOptionBtn);

        optionsWrapper.appendChild(optionWrapper);

        deleteOptionBtn.addEventListener('click', function() {
            optionsWrapper.removeChild(optionWrapper);
        });
    });


    optionsContainer.appendChild(optionsLabel);
    optionsContainer.appendChild(optionsWrapper);

    answerTypeSelect.addEventListener('change', function() {
        const selectedType = answerTypeSelect.value;
        if (
            selectedType === 'Multiple Choice' ||
            selectedType === 'Checkboxes' ||
            selectedType === 'Dropdown' ||
            selectedType === 'Radio Button'
        ) {
            optionsContainer.style.display = 'block'; // Show options
        } else {
            optionsContainer.style.display = 'none'; // Hide options
        }
    });

    const deleteButton = document.createElement('button');
    deleteButton.type = 'button';
    deleteButton.classList.add('ml-4', 'text-red-500', 'hover:text-red-700', 'focus:outline-none', 'focus:shadow-outline', 'delete-question-btn');
    deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';

    questionContent.appendChild(questionLabel);
    questionContent.appendChild(queID);
    questionContent.appendChild(questionInput);
    questionContent.appendChild(answerTypeSelect);
    questionContent.appendChild(pointsInput);
    questionContent.appendChild(requiredCheckboxWrapper);
    questionContent.appendChild(optionsContainer);

    questionItem.appendChild(questionContent);
    questionItem.appendChild(deleteButton);

    questionsContainer.appendChild(questionItem);

    deleteButton.addEventListener('click', function() {
        questionsContainer.removeChild(questionItem);
    });
});

// Form submit validation to check if answer type is selected
document.querySelector('form').addEventListener('submit', function(event) {
    const answerTypeSelects = document.querySelectorAll('.answer-type-select');
    let isValid = true;

    answerTypeSelects.forEach(function(select) {
        if (!select.value) {
            isValid = false;
            select.classList.add('border-red-500');
        } else {
            select.classList.remove('border-red-500');
        }
    });

    if (!isValid) {
        event.preventDefault(); // Prevent form submission
        alert('Please select an answer type for all questions.');
    }

    // Ensure at least one question is added
    const questionsContainer = document.getElementById('questionsContainer');
    if (questionsContainer.children.length === 0) {
        event.preventDefault();
        alert('Please add at least one question.');
    }
});

</script>
<script src="https://cdn.tailwindcss.com"></script>

@endsection
