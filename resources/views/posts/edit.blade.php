@extends('layouts.admin')

@section('main-content')
    <form action="{{ route('surveys.update', $survey->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Survey Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $survey->name }}" required>
        </div>

        <div id="questions-container">
            @foreach($survey->questions as $index => $question)
                <div class="form-group question-group" data-index="{{ $index }}">
                    <label for="question-{{ $index }}">Question {{ $index + 1 }}</label>
                    <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $question->id }}">
                    <input type="text" name="questions[{{ $index }}][content]" class="form-control" id="question-{{ $index }}" value="{{ $question->content }}" required>
                    <select name="questions[{{ $index }}][type]" class="form-control" onchange="updateQuestionOptions(this, {{ $index }})">
                        <option value="text" {{ $question->type == 'text' ? 'selected' : '' }}>Text</option>
                        <option value="number" {{ $question->type == 'number' ? 'selected' : '' }}>Number</option>
                        <option value="radio" {{ $question->type == 'radio' ? 'selected' : '' }}>Radio</option>
                        <option value="multiselect" {{ $question->type == 'multiselect' ? 'selected' : '' }}>Multiselect</option>
                    </select>
                    <div class="options-container">
                        @if($question->type == 'radio' || $question->type == 'multiselect')
                            @foreach($question->options as $optionIndex => $option)
                                <div class="form-group option-group">
                                    <input type="text" name="questions[{{ $index }}][options][]" class="form-control" value="{{ $option }}" required>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeOption(this)">Remove</button>
                                </div>
                            @endforeach
                            <button type="button" class="btn btn-secondary" onclick="addOption({{ $index }})">Add Option</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary" onclick="addQuestion()">Add Question</button>
        <button type="submit" class="btn btn-primary">Update Survey</button>
    </form>

    <script>
        let questionIndex = {{ $survey->questions->count() }};

        function addQuestion() {
            const container = document.getElementById('questions-container');
            const questionDiv = document.createElement('div');
            questionDiv.classList.add('form-group', 'question-group');
            questionDiv.setAttribute('data-index', questionIndex);
            questionDiv.innerHTML = `
                <label for="question-${questionIndex}">Question ${questionIndex + 1}</label>
                <input type="text" name="questions[${questionIndex}][content]" class="form-control" id="question-${questionIndex}" required>
                <select name="questions[${questionIndex}][type]" class="form-control" onchange="updateQuestionOptions(this, ${questionIndex})">
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="radio">Radio</option>
                    <option value="multiselect">Multiselect</option>
                </select>
                <div class="options-container"></div>
            `;
            container.appendChild(questionDiv);
            questionIndex++;
        }

        function updateQuestionOptions(selectElement, index) {
            const questionGroup = selectElement.closest('.question-group');
            const optionsContainer = questionGroup.querySelector('.options-container');
            optionsContainer.innerHTML = '';

            if (selectElement.value === 'radio' || selectElement.value === 'multiselect') {
                const addButton = document.createElement('button');
                addButton.type = 'button';
                addButton.classList.add('btn', 'btn-secondary');
                addButton.innerText = 'Add Option';
                addButton.onclick = () => addOption(index);
                optionsContainer.appendChild(addButton);
            }
        }

        function addOption(index) {
            const questionGroup = document.querySelector(`.question-group[data-index="${index}"]`);
            const optionsContainer = questionGroup.querySelector('.options-container');
            const optionDiv = document.createElement('div');
            optionDiv.classList.add('form-group', 'option-group');
            optionDiv.innerHTML = `
                <input type="text" name="questions[${index}][options][]" class="form-control" required>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeOption(this)">Remove</button>
            `;
            optionsContainer.insertBefore(optionDiv, optionsContainer.querySelector('button'));
        }

        function removeOption(button) {
            button.closest('.option-group').remove();
        }
    </script>
@endsection
