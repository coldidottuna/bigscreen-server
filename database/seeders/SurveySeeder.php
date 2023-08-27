<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $survey = new Survey();
        $survey->title = 'Sondage BigScreen';
        $survey->description = 
        'Afin de préparer la prochaine itération de leur application
        BigScreen un entreprise exerçant dans le domaine de la re&lit& virtuelle
        désire collecter des informations de la part de ses utilisateurs via un sondage en ligne.';
        $survey->save();

    }
}
