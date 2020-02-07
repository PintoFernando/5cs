<?php

use Illuminate\Database\Seeder;
use sis5cs\TipoContrato;

class TipoContratoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoContrato::create([
            'nombre_tc'=>'ITEM INDEFINIDO',
            'estado'=>true
                      
       ]);
         TipoContrato::create([
            'nombre_tc'=>'CONTRATO TEMPORAL',
            'estado'=>true     
       ]);
         TipoContrato::create([
            'nombre_tc'=>'CONTRATO DE RELEVO',
            'estado'=>true        
       ]);
          TipoContrato::create([
            'nombre_tc'=>'CONTRATO DE FORMACION APRENDIZAJE',
            'estado'=>true        
       ]);
    }
}
