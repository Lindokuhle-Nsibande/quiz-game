function homeMoveContainer(id, name_slug, name){
    var component = '<a href="/quiz/'+id+'/'+name_slug+'"><div class="each-movie-container bg-theme-blue ml-3 mr-3 w-60 h-48 rounded-md flex justify-center shadow-xl">'+
       '<h2 class="mt-auto mb-auto font-bold">'+name+'</h2>'+
   '</div></a>';
    return component;
}
function gameRadioBtn(id, answername, questionId){
    var component = '<div class="each-answer">'+
    '<input type="radio" value="'+answername+'" data-question-id="'+questionId+'" name="selector" id="i'+id+'">'+
    '<label for="i'+id+'">'+answername+'</label>'+
    '<div class="check"></div>'+
'</div>';

return component;
}
function resultsQuestionAnswers(num, question, answer, correctAnswer){
    if(answer == correctAnswer){
        answer = '<p class="correct-answer">Your Answer: '+answer+'</p>';
    }else{
        answer = '<p class="wrong-answer">Your Answer: '+answer+'</p>';
    }
    var component = '<div class="each-question-container mb-3 py-3">'+
    '<span class="block">'+num+'</span>'+
    '<p class="font-black">'+question+'</p>'+
    answer+
    '<p>Correct Answer: '+correctAnswer+'</p>'+
'</div>';

return component;
}