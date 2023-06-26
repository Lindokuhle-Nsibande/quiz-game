<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Quiz::truncate();
        Question::truncate();
        Answer::truncate();

        Quiz::create([
            'id' => 1,
            'name' => 'Game of Thrones',
            'slug' => 'game_of_thrones',
        ]);
        Quiz::create([
            'id' => 2,
            'name' => 'Breaking Bad',
            'slug' => 'breaking_bad',
        ]);

        Question::create([
            'id' => 1,
            'quiz_id' => 1,
            'question' => "What is the surname given to bastards born in Dorne?",
        ]);
        Question::create([
            'id' => 2,
            'quiz_id' => 1,
            'question' => "The Mountain' is the nickname for which character?",
        ]);
        Question::create([
            'id' => 3,
            'quiz_id' => 1,
            'question' => "Who is Lord Commander of the Kingsguard at the beginning of Game of Thrones?",
        ]);
        Question::create([
            'id' => 4,
            'quiz_id' => 1,
            'question' => "Who was Margaery Tyrell's first husband?",
        ]);
        Question::create([
            'id' => 5,
            'quiz_id' => 1,
            'question' => "Who is known as 'The-King-Beyond-the-Wall'?",
        ]);

        Question::create([
            'id' => 6,
            'quiz_id' => 2,
            'question' => "What is Walt’s middle name?",
        ]);
        Question::create([
            'id' => 7,
            'quiz_id' => 2,
            'question' => "What is the plant Walt used to poison Brock?",
        ]);
        Question::create([
            'id' => 8,
            'quiz_id' => 2,
            'question' => "What is the name of the boy Todd shot in the desert?",
        ]);
        Question::create([
            'id' => 9,
            'quiz_id' => 2,
            'question' => "What is the model of Walt’s original car?",
        ]);
        Question::create([
            'id' => 10,
            'quiz_id' => 2,
            'question' => "Before becoming Walt’s partner, Jesse cooked his meth with what special ingredient?",
        ]);


        Answer::create([
            'question_id' => 1,
            'answer' => "Rivers",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 1,
            'answer' => "Waters",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 1,
            'answer' => "Stone",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 1,
            'answer' => "Sand",
            'isCorrect' => "true",
        ]);


        Answer::create([
            'question_id' => 2,
            'answer' => "Gerold Clegane",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 2,
            'answer' => "Gregor Clegane",
            'isCorrect' => "true",
        ]);
        Answer::create([
            'question_id' => 2,
            'answer' => "Oberyn Martell",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 2,
            'answer' => "Sandor Clegane",
            'isCorrect' => "false",
        ]);


        Answer::create([
            'question_id' => 3,
            'answer' => "Ser Barristan Selmy",
            'isCorrect' => "true",
        ]);
        Answer::create([
            'question_id' => 3,
            'answer' => "Ser Loras Tyrell",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 3,
            'answer' => "Ser Jaime Lannister",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 3,
            'answer' => "Ser Jeor Mormont",
            'isCorrect' => "false",
        ]);

        Answer::create([
            'question_id' => 4,
            'answer' => "Renly Baratheon",
            'isCorrect' => "true",
        ]);
        Answer::create([
            'question_id' => 4,
            'answer' => "Joffrey Baratheon",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 4,
            'answer' => "Tommen Baratheon",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 4,
            'answer' => "Stannis Baratheon",
            'isCorrect' => "false",
        ]);


        Answer::create([
            'question_id' => 5,
            'answer' => "Mance Rayder",
            'isCorrect' => "true",
        ]);
        Answer::create([
            'question_id' => 5,
            'answer' => "Tormund Giantsbane",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 5,
            'answer' => "Stannis Baratheon",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 5,
            'answer' => "The Night King",
            'isCorrect' => "false",
        ]);


        Answer::create([
            'question_id' => 6,
            'answer' => "Archibald",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 6,
            'answer' => "Matthew",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 6,
            'answer' => "Hartwell",
            'isCorrect' => "true",
        ]);


        Answer::create([
            'question_id' => 7,
            'answer' => "Narcissus",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 7,
            'answer' => "Lily-of-the-valley",
            'isCorrect' => "true",
        ]);
        Answer::create([
            'question_id' => 7,
            'answer' => "Black Nightshade",
            'isCorrect' => "false",
        ]);


        Answer::create([
            'question_id' => 8,
            'answer' => "Drew Sharp",
            'isCorrect' => "true",
        ]);
        Answer::create([
            'question_id' => 8,
            'answer' => "David Stewart",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 8,
            'answer' => "Donnie Solis",
            'isCorrect' => "false",
        ]);


        Answer::create([
            'question_id' => 9,
            'answer' => "1987 Toyota Tercel",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 9,
            'answer' => "2004 Pontiac Aztek",
            'isCorrect' => "true",
        ]);
        Answer::create([
            'question_id' => 9,
            'answer' => "2006 PT Cruiser",
            'isCorrect' => "false",
        ]);


        Answer::create([
            'question_id' => 10,
            'answer' => "Chili powder",
            'isCorrect' => "true",
        ]);
        Answer::create([
            'question_id' => 10,
            'answer' => "A1 Steal Sauce",
            'isCorrect' => "false",
        ]);
        Answer::create([
            'question_id' => 10,
            'answer' => "Oregano",
            'isCorrect' => "false",
        ]);
    }


}
