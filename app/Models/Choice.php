<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = [
        'question_id',
        'label'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
