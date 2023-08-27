<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Survey;
use App\Models\Question;
use App\Models\User;
use App\Models\Answer;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\ChoiceResource;
use Illuminate\Support\Collection;


class HandleSurveyController extends Controller
{
    //
        //creer un nouveau sondage
public function surveyNew (Request $request){
    $survey = new Survey();
    $survey->title = $request->title;
    $survey->description = $request->description;
    $survey->save();

    // demande d'adresse mail requise pour tout les sondages 
    $question = new Question();
    $question->survey_id = $survey->id;
    $question->body = " Votre Adresse email ?";
    $question->type = "B";
    $question->save();

    return response()->json([
        'message' => "Nouveau sondage enregistré avec succès",
    ]);
}


// Ajouter des questions au nouveau sondage
public function questionsNew (Request $request ){
    $question = new Question();
    $question->survey_id = $request->input("survey_id");
    $question->body = $request->input("body");
    $question->type = $request->input("type");
    $question->save();

    if ($question->type == "A"){
        foreach ($request->choice as $option){
            $choice = new Choice();
            $choice->question_id = $question->id;
            $choice->label = $option;
            $choice->save();
        } }

        return response()->json([
            'message' => "Question enregistrée avec succès",
        ]);
    }

    //reccuperer toutes les questions des utilisateurs 
    public function answers (int $id){
        $survey = Survey::findOrfail($id);
        if($survey){
            return response()->json([
                    'message' => 'Liste des questions',
                    'data' => AnswerResource::collection(Answer::all())
            ],  200, [], JSON_PRETTY_PRINT   );
        }
    }

    public function answersRadar(int $id)
    {
        $survey = Survey::findOrFail($id);
        
        if ($survey) {
            $questions = $survey->questions->whereIn('id', [11, 12, 13, 14, 15]);
            
            $data = $questions->map(function ($question) {
                $average = $question->answers->avg('answer');
                
                return [
                    'title' => $question->body,
                    'average' => $average,
                ];
            });
            
            return response()->json([
                'message' => 'Moyenne',
                'data' => $data,
            ], 200, [], JSON_PRETTY_PRINT);
        }
    }
    

    public function countChoices(int $id, int $questionId, string $choiceLabel)
    {
        $question = Question::findOrFail($questionId);
        
        if ($question->type === 'A') {
            $choiceCount = $question->answers->where('answer', $choiceLabel)->count();
            
            return response()->json([
                'message' => 'Comptage des choix',
                'choice' => $choiceLabel,
                'count' => $choiceCount,
            ], 200, [], JSON_PRETTY_PRINT);
        } else {
            return response()->json(['message' => 'Question non compatible avec le comptage de choix'], 400);
        }
    }
    
}
