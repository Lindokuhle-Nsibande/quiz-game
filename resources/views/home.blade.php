@extends('layout')

@section('page-title')
    <title>Movie Quiz | Home</title>
@endsection
<x-navigation/>
@section('content')
    <section class="container m-auto min-h-full align-middle flex justify-center">
        <div class="home-body-container mt-auto mb-auto">
            <div class="">
                <h1 class="mb-8 font-black text-2xl text-center">Choose Quiz Topic</h1>
                <div class="movies-container flex flex-wrap">
                    {{-- <a href="#"><div class="each-movie-container
                     bg-theme-blue
                     ml-3 mr-3 w-60 h-48 rounded-md flex justify-center shadow-xl">
                        <h2 class="mt-auto mb-auto font-bold">Game Of Thrones</h2>
                    </div></a>
                    <div class="each-movie-container
                    bg-theme-blue
                    ml-3 mr-3 w-60 h-48 rounded-md flex justify-center shadow-xl">
                       <h2 class="mt-auto mb-auto font-bold">Breaking Bad</h2>
                   </div> --}}
                </div>

            </div>
        </div>
    </section>

    <div class="Setting-container">
        <div class="header p-4">
            <button class="text-2xl"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="body-container px-4">
            <div class="input-container mb-5">
                <label class="w-full block mb-2" for="play_as">Play As</label>
                <select name="" id="play_as" class="bg-theme-dark-blue p-3 w-full">
                    <option value="solo_player">Solo Player</option>
                    <option value="two_teams">Two Teams</option>
                </select>
            </div>
            <div class="input-container mb-5">
                <label class="w-full block mb-2" for="timer">Timer For Each Question (seconds)</label>
                <input type="text" id="timer" class="bg-theme-dark-blue p-3 w-full" value="10">
            </div>
        </div>
        <div class="footer-container absolute bottom-4 flex px-4">
            <button class="save px-7 py-3 bg-light mr-3 font-bold rounded-md">Save</button><button class="close bg-theme-dark-blue px-7 py-3 font-bold rounded-md">Cancel</button>
        </div>
    </div>
@endsection
@section('script')
<script>
    var token = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function () {
        setQuiz();
        setSettings();
        $('.settings-container i').on('click', function(){
            openCloseSettings();
        });
        $('.Setting-container .header button, .Setting-container .footer-container button.close').on('click', function(){
            openCloseSettings();
        });
        $('.Setting-container .footer-container button.save').on('click', function(){
            var play_as = $('#play_as').val();
            var timer = $('#timer').val();
            if(timer > 1){
                saveSettings(token, play_as, timer);
                openCloseSettings();
            }else{
                alert('please provide a valid timer in seconds');
            }
        });
    });
</script>
@endsection