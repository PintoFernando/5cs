<?php

use Illuminate\Database\Seeder;
use sis5cs\Direccion;
class DireccionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Direccion::create([
            'direc_numero'=>'123',                    
            'ciudad'=>'Potosi',                     
            'provincia'=>'Tomas Frias',                     
            'localidad'=>'Potosi',                     
            'zona'=>'Satelite',                     
            'distrito'=>'12',                     
            'barrio'=>'Satelite',                     
            'cll_principal'=>'Calle Costarica',                     
            'cll_secundaria'=>'Consumo',                     
            'tiempo_residencia'=>'12-12-1999',                     
            'id_persona'=>1,                     
            'id_tipo_vivienda'=>2                     
       ]);
    }
}
