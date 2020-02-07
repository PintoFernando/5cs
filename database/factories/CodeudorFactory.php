<?php

use Faker\Generator as Faker;
use sis5cs\Codeudor;

$factory->define(Codeudor::class, function (Faker $faker) {
    return [
    	'id_persona'=>$faker->numberBetween($min = 1, $max = 50),
    	'id_cliente'=>$faker->numberBetween($min = 1, $max = 50)
    ];
});
