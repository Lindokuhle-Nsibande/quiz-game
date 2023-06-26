<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
{
    //
    public static function getShuffledQuestionByQuizId($quizId){
        $questionObj = new Question();
        $result = $questionObj->getAll()->where('quiz_id', '==', $quizId)->shuffle();
        if($result == null){
            $result = [];
        }
        // check if the setting is set to two player
        if(session('settings') != null){
            if(session('settings')['play_as'] == 'solo_player'){
                return $result;
            }else{
                $results = $result->each(function($item, $key){
                    // check if it a first team question or the second team's
                    $num = $key + 1;
                    if($num % 2 != 0){
                        $item['player'] = 'Team A';
                        return $item;
                    }else{
                        $item['player'] = 'Team B';
                        return $item;
                    }
                });
                return $results;
            }
        }
    }
    public static function getQuestionById($id){
        $questionObj = new Question();
        $result = $questionObj->getAll()->where('id', '==', $id);
        return $result->first();
    }
    // Prepare questions for a given quiz using it's id
    public static function prepareQuestionsByQuizId($quizId){

        QuizController::getQuizSettings();
        // check if is/was there any on going quiz question of the cookies
        if(session('questions') != null){
            // delete the cookie with questions
            session()->forget('questions');
            session()->forget('score');

            // recreate the questions 
            $result = static::getShuffledQuestionByQuizId($quizId);
            
            session()->put('questions', $result);

            return $result->first();
        }else{
            // create the questions for the quiz and shuffle them
            $result = static::getShuffledQuestionByQuizId($quizId);
            session()->put('questions', $result);
            
            return $result->first();

        }
        
    }
    // Function that gets the next question from the cache
    public static function getNextQuestion(Request $request){
        // validate the values posted
        $validator = Validator::make($request->all(), [
            'quizId' => 'required',
            'currentQuestionId' => 'required',
            'answer' => 'required',
            'nextQuestionIndex' => 'required'
        ]);
        if($validator->fails()){
            // returns an error if the values don't meet the validation requirement
            return response()->json([
                'status'=>400,
                'response'=>$validator->errors()
            ]);
        }else{
            // Get the value posted
            $index = $request->input('nextQuestionIndex');
            $answer = $request->input('answer');
            $questionId = $request->input('currentQuestionId');
            $questions = session('questions');
            if($index == 0){
                dd('limit');
            }
            // Check if all the questions have been send to the user
            if($index != 0 && $index < $questions->count()){
                // return the next question if their is still questions left
                static::checkAnswer($answer, $questionId);
                return $questions[$index];
            }
            if($index == $questions->count()){
                // return the score with a response 200 if their no more questions
                static::checkAnswer($answer, $questionId);
                return session('score');
            }
        }
    }
    public static function checkAnswer($answer, $questionId){
      
        $answerObj = new Answer();
        $correctAnswer = $answerObj->getAll()
                                    ->where('question_id', '==', $questionId)
                                    ->where('isCorrect', '==', "true")->value('answer');

        QuizController::storeToScore($questionId, $answer, $correctAnswer);

    }



}
