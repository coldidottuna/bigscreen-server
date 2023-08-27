<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Survey;
use App\Models\Choice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $survey = Survey::first(); // Récupère le premier sondage
        //
        $data = [
            [
                'title' => 'Question 1',
                'body'=> 'Votre Adresse email ? ',
                'type' => 'B'
            ],
            [
                'title' => 'Question 2',
                'body'=> 'Votre Age ?',
                'type' => 'B'
            ],
            [
                'title' => 'Question 3',
                'body'=> 'Votre sexe ?',
                'type' => 'A',
                'options' => ['Homme', 'Femme', 'Non binaire', 'Préfère ne pas repondre' ]
            ],
            [
                'title' => 'Question 4',
                'body'=> 'Nombre de personnes dans votre foyer (adulte & enfants - répondant inclus) ?',
                'type' => 'C',
            ],
            [
                'title' => 'Question 5',
                'body'=> 'Votre Profession ?',
                'type' => 'B',
            ],
            [
                'title' => 'Question 6',
                'body'=> 'Quelle marque de casque VR utilisez-vous ?',
                'type' => 'A',
                'options' => ['Oculus Quest', 'Oculus Rift/s',' HTC Vive', 'Windows MixedReality', 'Valve index']
            ],
            [
                'title' => 'Question 7',
                'body'=> "Sur quel magasin d'application achetez-vous des contenus VR ?",
                'type' => 'A',
                'options' => ['SteamVR', 'Occulus store', 'Viveport', 'Windows store']
            ],
            [
                'title' => 'Question 8',
                'body'=> "Quel casque envisagez-vous d'acheter dans un futur proche ?",
                'type' => 'A',
                'options' => ['Occulus Quest', 'Occulus Go', 'HTC Vive Pro', 'PSVR', 'Autre', 'Aucun']
            ],
            [
                'title' => 'Question 9',
                'body'=> "Au sein de votre foyer, combien de personnes utilisent votre casque VR pour regarder Bigscreen?",
                'type' => 'C',
            ],
            [
                'title' => 'Question 10',
                'body'=> "Vous utilisez principalement Bigscreen pour ….. ?",
                'type' => 'A',
                'options' => ['regarder la TV en direct', 'regarder des films', 'travailler', 'jouer en solo', 'jouer en équipe']
            ],
            [
                'title' => 'Question 11',
                'body'=> "Combien de points (de 1 à 5) donnez-vous à la qualité de l'image sur Bigscreen ?",
                'type' => 'C',
            ],
            [
                'title' => 'Question 12',
                'body'=> "Combien de points (de 1 à 5) donnez-vous au confort d'utilisation de l'interface Bigscreen ?",
                'type' => 'C',
            ],
            [
                'title' => 'Question 13',
                'body'=> "Combien de points (de 1 à 5) donnez-vous à la connexion réseau de Bigscreen ?",
                'type' => 'C',
            ],
            [
                'title' => 'Question 14',
                'body'=> "Combien de points (de 1 à 5) donnez-vous à la qualité des graphismes 3D dans Bigscreen  ?",
                'type' => 'C',
            ],
            [
                'title' => 'Question 15',
                'body'=> "Combien de points (de 1 à 5) donnez-vous à la qualité audio dans Bigscreen  ?",
                'type' => 'C',
            ],
            [
                'title' => 'Question 16',
                'body'=> "Aimeriez-vous avoir des notifications plus précises au cours de vos sessions Bigscreen ?",
                'type' => 'A',
                'options' => ['Oui', 'Non']
            ],
            [
                'title' => 'Question 17',
                'body'=> "Aimeriez-vous pouvoir inviter un ami à rejoindre votre session via son smartphone ?",
                'type' => 'A',
                'options' => ['Oui', 'Non']
            ],
            [
                'title' => 'Question 18',
                'body'=> "Aimeriez-vous pouvoir enregistrer des émissions TV pour pouvoir les regarder ultérieurement ?",
                'type' => 'A',
                'options' => ['Oui', 'Non']
            ],
            [
                'title' => 'Question 19',
                'body'=> "Aimeriez-vous jouer à des jeux exclusifs sur votre Bigscreen ?",
                'type' => 'A',
                'options' => ['Oui', 'Non']
            ],
            [
                'title' => 'Question 20',
                'body'=> 'Selon vous, quelle nouvelle fonctionnalité devrait exister sur Bigscreen ?',
                'type' => 'B',
            ],
        ];
        foreach ($data as $questionData) {
            $question = new Question();
            $question->survey_id = $survey->id;
            $question->body = $questionData['body'];
            $question->type = $questionData['type'];
            $question->save();

            if ($questionData['type'] === 'A' && isset($questionData['options'])) {
                foreach ($questionData['options'] as $option) {
                    $choice = new Choice();
                    $choice->question_id = $question->id;
                    $choice->label = $option;
                    $choice->save();
                }
            }
        }
        
        
    }
}
