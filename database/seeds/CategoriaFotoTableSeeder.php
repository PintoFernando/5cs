<?php

use Illuminate\Database\Seeder;
use sis5cs\CategoriaFoto;

class CategoriaFotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoriaFoto::create([
            'categoria'=>'Automovil',
            'estado'=>true
        ]);
        CategoriaFoto::create([
            'categoria'=>'Inmueble',
             'estado'=>true
        ]);
        CategoriaFoto::create([
            'categoria'=>'Bienes del hogar',
             'estado'=>true
        ]);
        CategoriaFoto::create([
            'categoria'=>'Otro',
             'estado'=>true
        ]);

    }
}
