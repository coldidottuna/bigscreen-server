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



class SurveyController extends Controller
{
// Questions du sondage concerné
    public function question (int $id){
        $survey = Survey::findOrfail($id);
        if ($survey){
            try{
                return response()->json([
                    'status' => "Done",
                    'message' => 'Liste des questions',
                    'data' => QuestionResource::collection(Question::all()),
                ],  200, [], JSON_PRETTY_PRINT);
            
            } catch (Exception $e) {
                return response()->json([
                    'status' => "Error",
                    'error' => $e->getMessage() 
                ]);
            }
        }
    }

 // reponses d'un sondé
    public function answers ( int $id, string $token){
        $survey_id = Survey::findOrfail($id);
        $user_token = User::where("token", $token)->firstOrFail() ;
        $answers = $user_token->answers;
        if($user_token){
            try{
                return response()->json([
                    'status' => "Done",
                    'message' => 'Liste des questions',
                    'data' => AnswerResource::collection($answers),
                    
                ],  200, [], JSON_PRETTY_PRINT);
            
            } catch (Exception $e) {
                return response()->json([
                    'status' => "Error",
                    'error' => $e->getMessage() 
                ]);
            }
        }
    }


// reccuperer et verifier les reponses envoyés par l'utilisateur 
    public function submitAnswers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        if ($validator->fails()) {
            return response()->json(['e-mail invalide, veuillez entrez une adresse valide !' => $validator->errors()], 400);
        }
        $email = $request->input('email');
        // Vérifier si l'e-mail existe dans la base de données
        $user = User::where('email', $email)->first();
        if (!$user) {
            // L'utilisateur n'existe pas, créer un nouvel enregistrement
            $user = new User();
            $user->email = $email;
            $user->save();
            // L'utilisateur n'a jamais participé au sondage, enregistrer les réponses
            // ...
            return response()->json(['message' => 'Réponses enregistrées avec succès'], 200);
        }
        // Vérifier si l'utilisateur a déjà participé au sondage
        $hasParticipated = Answer::where('user_id', $user->id)->exists();
        if (!$hasParticipated) {
            // L'utilisateur a déjà un compte mais n'a pas participé à ce sondage, enregistrer les réponses
            // ...
            return response()->json(['message' => 'Réponses enregistrées avec succès'], 200);
        }
        // L'utilisateur a déjà participé au sondage
        return response()->json(['message' => 'L\'utilisateur a déjà participé au sondage'], 400);
    }

 //   
    public function answersPost(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'survey_id'=>'required'
        ]);

        
    }





}


