<?php

namespace App\Http\Controllers;

use App\Models\PlaceChoices;
use Illuminate\Http\Request;
use App\Models\PlaceQuestion;
use App\Models\PlacementQuestion;
use App\Models\PlacementUserAnswer;
use App\Models\PlacementUserResult;
use Illuminate\Support\Facades\Auth;

class PlacementQuestionController extends Controller
{
    public function PlacementQuestion($question_set_number)
    {
        //get the current user that are logged in
        $userId = Auth::id();
        //cheking the db if the user already answered that question
        $answeredQuestionIds = PlacementUserAnswer::where('user_id', $userId)
            ->pluck('place_question_id')
            ->all();
        //in a case upper was true, it will execute this command that will paginate to next question
        $questions = PlaceQuestion::where('question_set_number', $question_set_number)
            ->whereNotIn('id', $answeredQuestionIds)
            ->paginate(1);
        //getting all the choices for a specific question. saving it in array
        $choices = [];
        foreach ($questions as $question) {
            $choices[$question->id] = PlaceChoices::where('place_question_id', $question->id)->get();
        }
        //just for displaying the total question per set of questions
        $numbers = PlaceQuestion::where('question_set_number', $question_set_number)->get();
        $totalQuestions = count($numbers);
        //unfinished redirect function for the user if the user already finished 1 whole set of questions for placement question
        // if ($totalQuestions === 0) {
        //     return redirect()->route('placement_question.finish');
        // }
        return view('User.placement_questions.placement_questions', compact('questions', 'choices', 'question_set_number', 'totalQuestions'));
    }

    public function saveUserAnswer(Request $request, $questionId)
    {
        //this is just simple saving data from the different tables in the schema
        $userId = Auth::id();
        $existingAnswer = PlacementUserAnswer::where('user_id', $userId)
            ->where('place_question_id', $questionId)
            ->first();

        if ($existingAnswer) {
            return back()->with('error', 'You have already answered this question.');
        }
        $selectedChoiceId = $request->input('choices_id');
        $selectedChoice = PlaceChoices::find($selectedChoiceId);
        if ($selectedChoice) {
            $userAnswer = new PlacementUserAnswer();
            $userAnswer->place_choice_id = $selectedChoiceId;
            $userAnswer->user_id = $userId;
            $userAnswer->user_answer = $selectedChoice->choices_letter;
            $userAnswer->place_question_id = $questionId;
            $userAnswer->save();
            $question = PlaceQuestion::find($questionId);
            if ($question && $userAnswer->user_answer === $question->correct_answer) {
                $userAnswer->update(['place_question_status' => 1]);
            } else {
                $userAnswer->update(['place_question_status' => 0]);
            }
        }
        return back();
    }


    public function PlacementFinish()
    {
        $userId = Auth::id();
        //getting all the data
        $questionSetNumbers = PlacementUserAnswer::where('user_id', $userId)
            ->join('place_questions', 'placement_user_answers.place_question_id', '=', 'place_questions.id')
            ->distinct('place_questions.question_set_number')
            ->pluck('place_questions.question_set_number')
            ->all();
        //storage for the (1) status
        $userScores = [];
        //counting how many correct answer (1) on the table of placement_user_answers by the column place_question_status
        foreach ($questionSetNumbers as $questionSetNumber) {
            $totalCorrectAnswers = PlacementUserAnswer::where('user_id', $userId)
                ->join('place_questions', 'placement_user_answers.place_question_id', '=', 'place_questions.id')
                ->where('place_questions.question_set_number', $questionSetNumber)
                ->where('place_question_status', 1)
                ->count();
            //posting the data to the database
            PlacementUserResult::updateOrCreate(
                [
                    'user_id' => $userId,
                    'placement_question_set_id' => $questionSetNumber,
                ],
                [
                    'user_total_correct_answer' => $totalCorrectAnswers,
                ]
            );
            $userScores[$questionSetNumber] = $totalCorrectAnswers;
        }
        return view('User.placement_questions.placement_finish', compact('userScores'));
    }
}
