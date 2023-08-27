<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        function AnswerData(Question $q, User $u){

            switch ($q->type){
                case 'A':
                    return [
                        'answer' =>$q->choices()->get()->random()->label,
                    ];
                case 'C':
                    return [
                        'answer' => collect([1,2,3,4,5])->random()
                    ];
                    default:
                    if($q->id == 1){
                        return [
                            'answer'=> $u->email
                        ];
                    } elseif ($q->id == 2){
                        return [
                            'answer'=> rand(18, 70)
                        ];
                    } elseif ($q->id == 5){
                        return [
                            'answer'=> fake()->jobTitle,
                        ];
                    }  elseif ($q->id == 20){
                        return [
                            'answer'=> fake()->sentence(),
                        ];
                    }
            }
        }


        //generer des reponses sauf pour l'admin
        User::all()->each(function(User $u){
            foreach (Question::all() as $q){
                if (!$u->is_admin){ 
                    Answer::create(
                        array_merge(
                            [
                                'survey_id'=> 1,
                                "question_id" =>$q->id,
                                "user_id" =>$u->id,
                        ],
                        AnswerData($q, $u)
                        )
                        );
                }

            }
        }
    );
    }


}
