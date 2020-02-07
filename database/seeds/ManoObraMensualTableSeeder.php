<?php

use Illuminate\Database\Seeder;
use sis5cs\ManoObraMensual;
class ManoObraMensualTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       ManoObraMensual::create([
            'descripcion_cargos'=>'portero',
            'num_personas'=>1,
            'sueldo_mensual'=>123.4,
            'id_persona'=>1                   
       ]);

   
    }
}
