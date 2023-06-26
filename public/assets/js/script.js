function getQuiz(Callback){
    $.ajax({
        type: "GET",
        url: "/quiz/get",
        dataType: "JSON",
        beforeSend:function(){

        },
        success: function (response) {
            Callback(response);            
        }
    });
}
function setQuiz(){
    getQuiz(function(response){
        var quizzes = "";

        $.each(response, function(key, val){
            quizzes += homeMoveContainer(val.id, val.slug, val.name);
        });

        $('.movies-container').html(quizzes);
    });
}
function getQuestionsByQuizId(quizId){
    $.ajax({
        type: "GET",
        url: "/quiz/question/"+quizId+"/get",
        dataType: "JSON",
        beforeSend:function(){

        },
        success: function (response) {
            Callback(response);            
        }
    });
}
function prepareQuestions(token, quizId){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
    $.ajax({
        type: "POST",
        url: "/quiz/prepare/",
        dataType: "JSON",
        data: {'quizId': quizId},
        beforeSend:function(){
            
        },
        success: function (response) {
            console.log(response);
            $('.before-start').remove();
            setQuestion(response);
            $('.count-down-timer').addClass('show');
        }
    });
}
function setQuestion(data){
    var answers = data.answer;
    // answers = answers.shuffle();
    // var points = [40, 100, 1, 5, 25, 10];

    for (i = answers.length -1; i > 0; i--) {
    j = Math.floor(Math.random() * i)
    k = answers[i]
    answers[i] = answers[j]
    answers[j] = k
    }
    answersList = ""
    $.each(answers, function(key, val){
        answersList += gameRadioBtn(val.id, val.answer, val.question_id);
    });
    
    var questionHtml = '<div class="each-question-container text-center">'+
        '<p class="text-xl">'+data.question+'</p>'+
        '<div class="answers-contaner">'+
        answersList+
        '</div>'+
    '</div>'
    if(data.player != undefined){
        $('.center-container h1').text(data.player);
    }
    $('.question-container').html(questionHtml);
}
function nextQuestion(token, quizId, questionId, answer, nextIndex){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
    $.ajax({
        type: "POST",
        url: "/quiz/next/question",
        dataType: "JSON",
        data: {
            'quizId': quizId,
            'currentQuestionId' : questionId,
            'answer' : answer,
            'nextQuestionIndex' : nextIndex
        },
        beforeSend:function(){
            
        },
        success: function (response) {
            if(response.answer != undefined){
                setQuestion(response);
                $questions = $('.question-left').text();
                $('.count-down-timer').text();
                $('.question-left').text($questions-1);
                if($questions == 1){
                    $('.game-card-container button').text('Finish');
                }
            }else{
                clearInterval(timer);
                setScoreResult();
                $('.answer-question-container').addClass('show');
            }        
        }
    });
}
function getQuestionById(id, Callback){
    $.ajax({
        type: "GET",
        url: "/get/question/"+id,
        dataType: "JSON",
        beforeSend:function(){

        },
        success: function (response) {
            Callback(response);            
        }
    });
}
function getSettings(Callback){
    $.ajax({
        type: "GET",
        url: "/get/settings",
        dataType: "JSON",
        beforeSend:function(){

        },
        success: function (response) {
            Callback(response);            
        }
    });
}
function setSettings(){
    getSettings(function(response){
        console.log(response);
        $('#play_as').val(response.play_as);
        $('#timer').val(response.timer);
    });
}
function saveSettings(token, play_as, timer){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
    $.ajax({
        type: "POST",
        url: "/save/settings",
        dataType: "JSON",
        data: {
            'play_as': play_as,
            'timer' : timer,
        },
        beforeSend:function(){
            
        },
        success: function (response) {
            openCloseSettings();
        }
    });
}
function getScoreInfo(Callback){
    $.ajax({
        type: "GET",
        url: "/get/score",
        dataType: "JSON",
        beforeSend:function(){

        },
        success: function (response) {
            console.log(response);
            Callback(response);            
        }
    });
}
function setScoreResult(){
    getScoreInfo(function(response){
        var answerslist = "";
        var count = 1
        var points = 0;
        var teamA = 0;
        var teamB = 0;
        $.each(response, function(key, val){
            console.log(val);
            if(val.team != undefined){
                if(val.team == "Team A"){
                    teamA += val.point; 
                }else{
                    teamB += val.point; 
                }
                answerslist += resultsQuestionAnswers(count+" - "+val.team, val.question.question, val.given_answer, val.correct_answer);
            }else{
                points += val.point;
                answerslist += resultsQuestionAnswers(count, val.question.question, val.given_answer, val.correct_answer);
            }
            count++;
        });
        if(teamA < teamB){
            $('.final-score h1').text('Team B Won');
        }else if(teamA == teamB){
            $('.final-score h1').text('It A Draw');
        }
        else{
            $('.final-score h1').text('Team A Won');
        }
        $('.team-a-score-container span').text(teamA);
        $('.team-b-score-container span').text(teamB);
        $('.sub-header, .header').remove();
        $('.final-score .won-points').text(points);
        $('.question-container').remove();
        $('.submit-container').remove();
        $('.answer-question-container').html(answerslist);
        $('.result-container').addClass('show');
    });    
}