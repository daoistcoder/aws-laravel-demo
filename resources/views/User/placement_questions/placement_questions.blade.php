<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Placement Questions</title>
</head>
<body>
    Placement Question

    @foreach ($questions as $question)
        <h3>Question {{ $question->place_question_number }} of {{ $totalQuestions }}</h3>
        <p>{{ $question->place_question_title }}</p>
        @if ($question->place_question_image)
            <iframe src="{{ $question->place_question_image }}" frameborder="0" width="600" height="400"></iframe>
        @endif
        <form action="{{ route('saveUserAnswer', $question->id) }}" method="POST">
            @csrf
            <p>Choices:</p>
            <ul style="list-style-type: upper-alpha;">
                @if (isset($choices[$question->id]) && count($choices[$question->id]) > 0)
                    @foreach ($choices[$question->id] as $choice)
                        <li>
                            <label>
                                <input type="radio" name="choices_id" value="{{ $choice->id }}">
                                {{ $choice->choices }}
                            </label>
                            @if ($choice->choices_img)
                                <iframe src="{{ $choice->choices_img }}" frameborder="0" width="400" height="200"></iframe>
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>
            <button type="submit">Submit</button>
        </form>
    @endforeach
</body>
</html>