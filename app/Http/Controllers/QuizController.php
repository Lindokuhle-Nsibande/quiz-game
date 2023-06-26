<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    //
    public static function getAllQuiz(){
        $quizObj = new Quiz();

        return $quizObj->getAll();
    }

    public static function getQuizByIdAndSlug($id, $slug){
        $quizObj = new Quiz();
        return $quizObj->getAll()->where('id', '==', $id)
                                ->where('slug', '==', $slug);
    }

    public static function setQuizSettings(Request $request){
        $validator = Validator::make($request->all(), [
            'play_as' => 'required',
            'timer' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'response'=>$validator->errors()
            ]);
        }else{
            $playAs = $request->input('play_as'); 
            $timer = $request->input('timer');

            $settings = [
                'play_as' => $playAs,
                'timer' => $timer
            ];
    
            session()->put('settings', $settings);
        }

    }
    public static function getQuizSettings(){
        if(session('settings') == null){
            $settings = [
                'play_as' => 'solo_player',
                'timer' => 10
            ];
            session()->put('settings', $settings);
        }
        return session('settings');
    }
    public static function storeToScore($questionId, $answer, $correctAnswer){
        if($answer == $correctAnswer){
            $point = 1;
        }else{
            $point = 0;
        }
        $data = [];
        $userData = [
            'questind_id' => $questionId,
            'given_answer' => $answer,
            'correct_answer' => $correctAnswer,
            'point' => $point
        ];
        
        if(session('questions') != null){
            $questions = session('questions');
            
            $team = "";
            foreach($questions as $item){
                if($item['id'] == $questionId){
                    $team = $item['player'];
                }
            };
            $userData = [
                'questind_id' => $questionId,
                'given_answer' => $answer,
                'correct_answer' => $correctAnswer,
                'point' => $point,
                'team' => $team
            ];

        }
        if(session('score') != null){
            $score = session('score');


            array_push($score, $userData);
            session()->put('score', $score);
        }else{
            array_push($data, $userData);
            session()->put('score', $data);
        }
    }
    public static function getScoreInfo(){
        if(session('score') != null){
            $result = [];
            $scores = session('score');
            foreach($scores as $item){
                $questionInfo = QuestionsController::getQuestionById($item['questind_id']);
                $result[] = [
                    'question' => $questionInfo,
                    'given_answer' => $item['given_answer'],
                    'correct_answer' => $item['correct_answer'],
                    'point' => $item['point'],
                    'team' => $item['team']
                ];
            };
            return $result;
        }
    }
}
