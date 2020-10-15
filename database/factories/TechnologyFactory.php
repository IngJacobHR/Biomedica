<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Technology;
use Faker\Generator as Faker;

$factory->define(Technology::class, function (Faker $faker) {
    return [
        //'active'=>$faker->numberBetween($min= 100, $max=500),
        'active'=>$faker->Sentence(1),
        'serie'=>$faker->numberBetween($min= 214500, $max=892308),
        'name'=>$faker->Sentence(1),
        'mark'=>$faker->Sentence(1),
        'model'=>$faker->Sentence(1),
        'location'=>$faker->randomElement(['Consultorio','Procedimiento','Vacunacion','Quirofano']),
        'campus'=>$faker->randomElement(['Centro','Norte','Oriental','Pac']),
        'category'=>$faker->randomElement(['R.Alto','R.Moderado','R.Bajo', 'Sin Riesgo']),
    ];
});
