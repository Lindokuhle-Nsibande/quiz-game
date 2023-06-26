<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    public function question(){
        return $this->hasMany(Question::class);
    }

    public function getAll(){
        return cache()->remember('quizes', now()->years(), function(){
            return Quiz::with(['question'])->get();
        });
    }
}
