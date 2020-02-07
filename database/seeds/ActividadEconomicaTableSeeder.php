<?php

use Illuminate\Database\Seeder;
use sis5cs\ActividadEconomica;

class ActividadEconomicaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         ActividadEconomica::create([
         'ciudad_ae'=>'Potosi',
         'provincia_ae'=>'Tomas Frias',
         'zona_ae'=>'San bernardo',
         'direccion_ae'=>'Calle Costarica',
         'telefono_ae'=>'45151512',
         'actividad_qrealiza'=>'Comerciante',
         'nit_ae'=>'2312312',
         'horario_trabajo_ae'=>'8:00 a 12:00 y 14:00 a 18:00',
         'dias_trabajo_ae'=>'Lunes a viernes',
         'antiguedad_trabajo_ae'=>'2014-02-12',
         'id_persona'=>1
        ]);
           
    }
}



