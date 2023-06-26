function openCloseSettings(){
    setting = $('.Setting-container');
    if(setting.hasClass('show')){
        setting.removeClass('show');
    }else{
        setting.addClass('show');
    }
}