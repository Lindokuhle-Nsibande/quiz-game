<?php

use Illuminate\Support\Facades\Route;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Http\Request;

use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\QuestionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/quiz/get', function(){
    return QuizController::getAllQuiz();
});
Route::get('/quiz/{id}/{slug}',function($id, $slug){
    $result = QuizController::getQuizByIdAndSlug($id, $slug);
    $questionsInfo = QuestionsController::prepareQuestionsByQuizId($id);
    $settings = QuizController::getQuizSettings();
    if($result->isNotEmpty()){
        return view('quiz', [
            'result' => $result,
            'questions' => session('questions'),
            'settings' => $settings
        ]);
    }else{
        return redirect(404);
    }
});
Route::Post('/quiz/prepare/', function(Request $request){
    $validator = Validator::make($request->all(), [
        'quizId' => 'required',
    ]);
    if($validator->fails()){
        return response()->json([
            'status'=>400,
            'response'=>$validator->errors()
        ]);
    }else{
        $quizId =  $quizId = $request->input('quizId');
        $result = QuestionsController::prepareQuestionsByQuizId($quizId);
        return $result;
    }
    
});
Route::post('/quiz/next/question',[
    QuestionsController::class, 'getNextQuestion'
]);
Route::get('/get/settings', [
    QuizController::class, 'getQuizSettings'
]);
Route::post('/save/settings',[
    QuizController::class, 'setQuizSettings'
]);
Route::get('/get/question/{id}', function($id){
    return QuestionsController::getQuestionById($id);
});
Route::get('/get/score', function(){
    return QuizController::getScoreInfo();
});