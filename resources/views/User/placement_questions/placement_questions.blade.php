<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href={{asset('images/mathayog-kite.png')}} type="image/x-icon">
    <title>Placement Questions</title>
    <link rel="stylesheet" href={{asset('/css/place_question.css')}}>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
    <div class="mathayog_logo1">
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

    @foreach ($questions as $index => $question)
        <div class="topbar">
            <h1>Placement</h1>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="{{ $question->place_question_number }}" aria-valuemin="0" aria-valuemax="{{ $totalQuestions }}" data-question-number="{{ $question->place_question_number }}"></div>
            </div>
            <div class="translation_globe">
                <div class="translation">
                    <img src="{{ asset('images/translate.png') }}" class="translate" id="translate" alt="translate">
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        English
                    </button>
                    <div class="dropdown-menu" aria-labelledby="languageDropdown">
                        <a class="dropdown-item" href="#" data-language="en">English</a>
                        <a class="dropdown-item" href="#" data-language="fil">Filipino</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-container">
            {{-- @foreach ($questions as $index => $question) --}}
            <div class="question_title">
                <h2>{{ $question->place_question_title }}</h2>
            </div>
            <div class="quiz-container quiz-selected" id="quiz">
                <form action="{{ route('saveUserAnswer', $question->id) }}" method="POST">

                    <div class="tools">
                        <img src="{{ asset('images/cursor.png')}}" class="" id="" alt="cursor">
                        <img src="{{ asset('images/hint.png')}}" class="" id="" alt="hint">
                    </div>
                    
                    <div class="question-container" data-question-index="{{ $index }}">
                        {{-- <h5>Question {{ $question->place_question_number }} of {{ $totalQuestions }}</h5> --}}
                        {{-- <div class="question_title">
                            <h2>{{ $question->place_question_title }}</h2>
                        </div> --}}
                        @if ($question->place_question_image)
                            <iframe src="{{ $question->place_question_image }}" frameborder="0" width="600" height="400"></iframe>
                        @endif
                        {{-- <form action="{{ route('saveUserAnswer', $question->id) }}" method="POST"> --}}
                            @csrf
                            <div class="answer-choices">
                                <ul style="list-style-type: none;">
                                    @if (isset($choices[$question->id]) && count($choices[$question->id]) > 0)
                                        @foreach ($choices[$question->id] as $choice)
                                        <li class="clickable-choice" data-has-iframe="{{ $choice->choices_img ? 'true' : 'false' }}" data-correct-answer="{{ $question->correct_answer }}" data-choice-letter="{{$choice->choices_letter}}" data-selected="{{ $choice->selected ? 'true' : 'false' }}">
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
                        {{-- </form> --}}
                    </div>
                    <div class="feedback-container">
                        <img src="{{ asset('images/feedbackCat.png')}}" class="guide_image animated" id="guide_image" alt="guide_image">
                        <div class="dialog" id="dialog">
                            <h3 id="title">Are you sure with your answer?</h3>
                        </div>
                        <button type="submit" class="patuloy" id="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('js/placement_questions.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function updateProgressBar(questionNumber, totalQuestions) {
            const progressBar = document.querySelector(`[data-question-number="${questionNumber}"]`);
            const progressPercentage = (questionNumber / totalQuestions) * 100;
            progressBar.style.width = `${progressPercentage}%`;
            progressBar.setAttribute('aria-valuenow', questionNumber);
        }
    
        // Call the function with the current question number and total questions
        updateProgressBar({{ $question->place_question_number }}, {{ $totalQuestions }});
    </script>
</body>
</html>