<?php

use Illuminate\Database\Seeder;
use sis5cs\TipoGarantia;
class TipoGarantiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       TipoGarantia::create([
            'tipo_garantia'=>'PERSONAL',
            'estado'=>true                     
       ]);
       TipoGarantia::create([
            'tipo_garantia'=>'HIPOTECARIO DE VIVIENDA',
               'estado'=>true                     
       ]);
       TipoGarantia::create([
            'tipo_garantia'=>'HIPOTECARIO DE VEHÍCULO',
            'estado'=>true                        
       ]);
       TipoGarantia::create([
            'tipo_garantia'=>'DEPÓSITO A PLAZO FIJO',
            'estado'=>true                        
       ]);
       TipoGarantia::create([
            'tipo_garantia'=>'PRENDARIO',
            'estado'=>true                       
       ]);
       TipoGarantia::create([
            'tipo_garantia'=>'OTROS',
            'estado'=>true                        
       ]);
    }
}
