<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicSurveyController;
use App\Http\Controllers\HandleSurveyController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// routes publiques
//route login admin
Route::post('/login', [UserController::class, 'login']) ;
Route::post('/logout', [UserController::class, 'logout']) ;

// reccuperer les questions
Route::get('survey/{id}/questions', [PublicSurveyController::class, 'question']);
// poster les reponses d'un utilisateur
Route::post('survey/{id}/answers/post', [PublicSurveyController::class, 'answersPost']);
// reccuperer les reponses d'un utilisateur
Route::get('survey/{id}/answers/{token}', [PublicSurveyController::class, 'answers']);



//route privée
Route::group(['middleware' => ['auth:sanctum']], function () {
// creer un nouveau sondage
Route::post('admin/survey/new', [HandleSurveyController::class, 'surveyNew']);
// Ajouter des questions au nouveau sondage
Route::post('admin/survey/new/questions', [HandleSurveyController::class, 'questionsNew']);
//reccuperer les reponses des utilisateurs
Route::get('admin/survey/{id}/answers', [HandleSurveyController::class, 'answers']);
//recuperer les reponses du type radar
Route::get('admin/survey/{id}/answers/radar', [HandleSurveyController::class, 'answersRadar']);
//recuperer les reponses du type pie
Route::get('admin/survey/{id}/{questionId}/answers/{choiceLabel}', [HandleSurveyController::class, 'countChoices']);




});



// creer des questions au niouveau sondage 

//reccuperer toutes les questions 
Route::get('answers', [SurveyController::class, 'answers_all']);

