document.getElementById('addQuestionBtn').addEventListener('click', function() {
    console.log('s')
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
    questionInput.classList.add('shadow', 'appearance-none', 'border', 'rounded', 'w-full', 'py-2', 'px-3', 'text-gray-700', 'leading-tight', 'focus:outline-none', 'focus:shadow-outline');
    questionInput.placeholder = 'Enter your question';

    const answerTypeSelect = document.createElement('select');
    answerTypeSelect.classList.add('mt-2', 'shadow', 'appearance-none', 'border', 'rounded', 'w-full', 'py-2', 'px-3', 'text-gray-700', 'leading-tight', 'focus:outline-none', 'focus:shadow-outline', 'answer-type-select');
    answerTypeSelect.innerHTML = `
        <option selected>Select answer type</option>
        <option value="1">Short Answer</option>
        <option value="2">Paragraph</option>
        <option value="3">Multiple Choice</option>
        <option value="4">Checkboxes</option>
        <option value="5">Dropdown</option>
        <option value="6">Radio Button</option>
        <option value="7">Time</option>
    `;

    const deleteButton = document.createElement('button');
    deleteButton.type = 'button';
    deleteButton.classList.add('ml-4', 'text-red-500', 'hover:text-red-700', 'focus:outline-none', 'focus:shadow-outline', 'delete-question-btn');
    deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';

    questionContent.appendChild(questionLabel);
    questionContent.appendChild(questionInput);
    questionContent.appendChild(answerTypeSelect);

    questionItem.appendChild(questionContent);
    questionItem.appendChild(deleteButton);

    questionsContainer.appendChild(questionItem);

    deleteButton.addEventListener('click', function() {
        questionsContainer.removeChild(questionItem);
    });
});
