<?php

use Illuminate\Database\Seeder;
use sis5cs\MaquinariaEquipo;
class MaquinariaEquipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MaquinariaEquipo::create([
            'descripcion' => 'Camioneta',
            'marca' => 'nissan',
            'modelo' => '2017',
            'anio' => '2017',
            'asegurado' => true,
            'aseguradora' => 'aseguradora',
            'entidad_acreedora' => 'Instituto',
            'total' => 8000,
            'id_persona' => 1
        ]);     
    }
}
