<?php

use Illuminate\Database\Seeder;
use sis5cs\EstadoCivil;

class EstadoCivilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoCivil::create([
            'estado_civil' => 'Casado(a)',
            'estado' => true
        ]);
        EstadoCivil::create([
            'estado_civil' => 'Soltero(a)',
            'estado' => true
        ]);
        EstadoCivil::create([
            'estado_civil' => 'Divorciado(a)',
            'estado' => true
        ]);
        EstadoCivil::create([
            'estado_civil' => 'Concubino(a)',
            'estado' => true
        ]);
        EstadoCivil::create([
            'estado_civil' => 'Viudo(a)',
            'estado' => true
        ]);
    }
}
