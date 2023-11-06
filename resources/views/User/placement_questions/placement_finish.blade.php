<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Placement Finish</title>
</head>
<body>
    <p>You have finished the Placement Questions.</p>
    @foreach($userScores as $questionSetNumber => $totalCorrectAnswers)
    <p>For Question Set {{ $questionSetNumber }}, your total score is: {{ $totalCorrectAnswers }}</p>
    @endforeach
</body>
</html>
