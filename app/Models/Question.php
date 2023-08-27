<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Question extends Model
{
    protected $fillable = [
        'survey_id',
        'body',
        'type'
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
