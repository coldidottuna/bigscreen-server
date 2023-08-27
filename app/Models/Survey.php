<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    // relation entre les tables survey et question pour associer des questions  a un même sondage
    public function questions(){
        return $this->hasMany(Question::Class);
    }

    // relation entre les tables survey et answer pour associer des reponses a un même sondage
    public function answers(){
        return $this->hasMany(Answer::Class);
    }



}
