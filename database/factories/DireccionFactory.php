<?php

use Faker\Generator as Faker;
use sis5cs\Direccion;
$factory->define(Direccion::class, function (Faker $faker) {
    return [
            'direc_numero'=>$faker->numberBetween($min = 1, $max = 1000),
            'ciudad'=>$faker->city,
            'provincia'=>$faker->city,
            'localidad'=>$faker->city,
            'zona'=>$faker->state,
            'distrito'=>$faker->state,
            'barrio'=>$faker->state,
            'cll_principal'=>$faker->streetName,
            'cll_secundaria'=>$faker->streetName,
            'tiempo_residencia'=>$faker->date($format = 'Y-m-d', $max = 'now'),
            'id_persona'=>$faker->numberBetween($min = 1, $max = 100),
            'id_croquis'=>$faker->numberBetween($min = 1, $max = 6),
            'id_tipo_vivienda'=>$faker->numberBetween($min = 1, $max = 7)
    ];
});
