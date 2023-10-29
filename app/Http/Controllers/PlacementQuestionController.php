<?php

namespace App\Http\Controllers;

use App\Models\PlaceChoices;
use Illuminate\Http\Request;
use App\Models\PlaceQuestion;
use App\Models\PlacementQuestion;

class PlacementQuestionController extends Controller
{
    public function PlacementQuestion($question_set_number)
    {
        $questions = PlaceQuestion::where('question_set_number', $question_set_number)->paginate(1);
        $choices = [];

        foreach ($questions as $question) {
            $choices[$question->id] = PlaceChoices::where('place_question_id', $question->id)->get();
        }

        $numbers = PlaceQuestion::where('question_set_number', $question_set_number)->get();
        $totalQuestions = count($numbers);

        return view('User.placement_questions.placement_questions', compact('questions', 'choices', 'question_set_number', 'totalQuestions'));
    }
}
