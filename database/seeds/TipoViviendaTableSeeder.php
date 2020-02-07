<?php

use Illuminate\Database\Seeder;
use sis5cs\TipoVivienda;

class TipoViviendaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoVivienda::create([
            'tipo_vivienda'=>'Propia',
            'estado'=>true
                      
       ]);

        TipoVivienda::create([
            'tipo_vivienda'=>'Familiar',
            'estado'=>true
                      
       ]);

        TipoVivienda::create([
            'tipo_vivienda'=>'Arrendada',
            'estado'=>true
                      
       ]);
        TipoVivienda::create([
            'tipo_vivienda'=>'Anticretico',
            'estado'=>true
                      
       ]);

        TipoVivienda::create([
            'tipo_vivienda'=>'Alquiler',
            'estado'=>true
                      
       ]);
        TipoVivienda::create([
            'tipo_vivienda'=>'Prestada',
            'estado'=>true
                      
       ]);

         TipoVivienda::create([
            'tipo_vivienda'=>'Otros',
            'estado'=>true
                      
       ]);
    }
}
