@extends('layout')
@section('page-title')
    <title>Movie Quiz | {{ $result->value('name') }}</title>
@endsection
<x-navigation/>
@php
    $timer = $settings['timer'];
@endphp
@section('content')
    <section class="container m-auto min-h-full align-middle flex justify-center">
        <div class="home-body-container mt-auto mb-auto w-full justify-center">
            <h1></h1>
            <div class="game-card-container bg-theme-blue p-5 rounded-md shadow-xl m-auto">
                <div class="header flex">
                    <div class="left-container">
                        <div class="icon-container">

                        </div>
                        <span class="font-bold">{{ $result->value('name') }}</span>
                    </div>
                    <div class="center-container mx-auto">
                        <h1 class="w-full text-center font-bold text-3xl"></h1>
                    </div>
                    <div class="right-side">
                        <span class="font-bold"><span class="question-left">{{ $questions->count() }}</span> QUESTIONS LEFT</span>
                    </div>
                </div>
                <div class="sub-header flex flex-wrap justify-center">
                    <span class="count-down-timer text-center font-black text-5xl" data-max="{{ $timer }}">{{ $timer }}</span>
                </div>
                <div class="before-start text-center p-10">
                    <h2 class="center text-2xl font-bold mb-3">Prepare yourself the quiz will start in:</h2>
                    
                    <span class="text-center text-4xl w-full"></span>
                </div>
                <div class="question-container">

                </div>
                <div class="result-container">
                    <h1 class="text-center font-black text-3xl">Results</h1>
                    <div class="answer-question-container">

                    </div>
                    {{-- <div class="each-question-container mb-3 py-3">
                        <span class="block">1</span>
                        <p class="font-black">What is the simplest most basic way to find out if a number/variable is odd or even in PHP? </p>
                        <p class="correct-answer">Your Answer: </p>
                        <p>Correct Answer: </p>
                    </div>
                    <div class="each-question-container mb-3 py-3">
                        <span class="block">1</span>
                        <p class="font-black">What is the simplest most basic way to find out if a number/variable is odd or even in PHP? </p>
                        <p class="wrong-answer">Your Answer: </p>
                        <p>Correct Answer: </p>
                    </div> --}}
                    @if (session('settings')['play_as'] == 'solo_player')
                        <div class="final-score solor text-center">
                            <span class="text-2xl font-regular"><span class="won-points"></span> Points Out Of {{ $questions->count() }} Points</span>
                        </div>
                    @else
                    <div class="final-score teams">
                        <h1 class="text-center font-black text-3xl">Team B Won</h1>
                        <div class="flex flex-wrap scores-table">
                            <div class="team-a-score-container mr-auto">
                                <h2>Team A</h2>
                                <span class="text-2xl font-regular">10</span>
                            </div>
                            <div class="team-b-score-container text-right">
                                <h2>Team B</h2>
                                <span class="text-2xl font-regular">10</span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="submit-container flex">
                    <button>Next Question <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </div>
            </div>
            
        </div>
    </section>
@endsection
@section('script')
<script>
    var token = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function () {
        var count = 5;
        var qNum = 0;
        var quizId = {{ $result->value('id') }};
        $('.before-start span').text(count);        
        timer = setInterval(function() { 
            if(count == 0){
                clearInterval(timer);
                prepareQuestions(token, quizId);
                qTimer = setInterval(function(){
                    var timerTxt = $('.count-down-timer').text();
                    $('.count-down-timer').text(timerTxt -1)
                    if(timerTxt == 0){
                        questionId = $('input[name="selector"]').eq(0).attr('data-question-id');
                        answer = "null"
                        qNum++;
                        console.log(questionId);
                        nextQuestion(token, quizId, questionId, answer, qNum);
                        $('.count-down-timer').text({{ $timer }});
                    }
                }, 1000);
                window.onbeforeunload = function() {
                    return "Dude, are you sure you want to leave? Think of the kittens!";
                }
            }else{
                count = count - 1;
            }
            
            $('.before-start span').text(count);
        }, 1000);        
        $('.submit-container button').on('click', function(){
            qNum++;
            $('.count-down-timer').text({{ $timer }});
            var answer = $('input[name="selector"]:checked').val();
            var questionId = $('input[name="selector"]:checked').attr('data-question-id');
            console.log(questionId);
            if(answer != undefined){
                nextQuestion(token, quizId, questionId, answer, qNum);
            }else{
                alert('please select answer');
            }
            
        });
       
    });
</script>
@endsection