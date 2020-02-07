<?php

use Faker\Generator as Faker;
use sis5cs\Cliente;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
            
            'id_persona'=>$faker->numberBetween($min = 1, $max = 10),
           
    ];
});
