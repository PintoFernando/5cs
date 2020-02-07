<?php

use Illuminate\Database\Seeder;
use sis5cs\TipoAmortizacion;
class TipoAmortizacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoAmortizacion::create([
            'amortizacion'=>'SOBRE SALDOS',
            'estado'=>true                      
       ]);
        TipoAmortizacion::create([
            'amortizacion'=>'CUOTAS FIJAS',
            'estado'=>true  

       ]);
    }
}
