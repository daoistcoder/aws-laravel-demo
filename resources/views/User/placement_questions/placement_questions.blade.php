<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href={{asset('images/mathayog-kite.png')}} type="image/x-icon">
    <title>Placement Questions</title>
    <link rel="stylesheet" href={{asset('/css/place_question.css')}}>
</head>
<body>
    <div class="container">
        <div class="row mathayog_logo1">
            <div class="mathayog_blue_logo">
                <img src="{{ asset('images/mathayog_blue.png') }}" class="mathayog_logo" alt="mathayog">
                <div class="profile_container">
                    <div class="profile_name">
                        <h5>
                            @auth
                                <?php
                                $firstName = Auth::user()->firstname;
                                $lastName = Auth::user()->lastname;
                                $capitalizedFirstName = ucfirst($firstName);
                                $capitalizedLastName = ucfirst($lastName);
                                ?>
                            {{ $capitalizedFirstName }} {{ $capitalizedLastName }}
                            @endauth
                        </h5>
                    </div>
                    <div class="profile_image">
                        <img id="profileImage" class="profile" alt="profile">
                    </div>
                </div>                    
            </div>
        </div>
  
        <div class="quiz-container quiz-selected" id="quiz">
            @foreach ($questions as $question)
                <h5>Question {{ $question->place_question_number }} of {{ $totalQuestions }}</h5>
                <h2>{{ $question->place_question_title }}</h2>
                @if ($question->place_question_image)
                    <iframe src="{{ $question->place_question_image }}" frameborder="0" width="600" height="400"></iframe>
                @endif
                <form action="{{ route('saveUserAnswer', $question->id) }}" method="POST">
                    @csrf
                    <div class="answer-choices">
                        <ul style="list-style-type: none;">
                            @if (isset($choices[$question->id]) && count($choices[$question->id]) > 0)
                                @foreach ($choices[$question->id] as $choice)
                                <li class="clickable-choice" data-has-iframe="{{ $choice->choices_img ? 'true' : 'false' }}">
                                    {{ $choice->choices_letter }} .
                                    <input type="radio" name="choices_id" value="{{ $choice->id }}" id="choice_{{ $choice->id }}" style="display: none;">
                                    <label for="choice_{{ $choice->id }}">{{ $choice->choices }}</label>
                                    @if ($choice->choices_img)
                                        <iframe src="{{ $choice->choices_img }}" frameborder="0" width="400" height="200" class="iframe-link"></iframe>
                                    @endif
                                </li>                                
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <button type="submit" class="btn">Submit</button>
                </form>
            @endforeach
        </div>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const clickableChoices = document.querySelectorAll('.clickable-choice');
    let selectedChoice = null;
    let quizContainer = document.querySelector('.quiz-container'); // Get the quiz container
    let hasIframeQuestion = false;

    clickableChoices.forEach(choice => {
        if (choice.getAttribute('data-has-iframe') !== 'true') {
            choice.style.height = '10vh'; // Set the initial height to 10vh for non-iframe choices
        } else {
            hasIframeQuestion = true;
        }

        choice.addEventListener('click', () => {
            if (selectedChoice) {
                // Remove the "selected-choice" class from the previously selected choice
                selectedChoice.classList.remove('selected-choice');
                if (selectedChoice.getAttribute('data-has-iframe') !== 'true') {
                    selectedChoice.style.height = '10vh'; // Set the height back to 10vh for non-iframe choices
                }
            }

            // Add the "selected-choice" class to the newly clicked choice
            choice.classList.add('selected-choice');
            selectedChoice = choice;

            // When the user clicks the li, find the associated radio input and trigger a click on it.
            const radioInput = choice.querySelector('input[type="radio"]');
            if (radioInput) {
                radioInput.click();
            }
        });
    });

    if (hasIframeQuestion) {
        quizContainer.style.height = '60%'; // Change the quiz container height if at least one question has an iframe
    }
});

    </script>
    
</body>
</html>