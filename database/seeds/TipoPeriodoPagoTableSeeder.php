<?php

use Illuminate\Database\Seeder;
use sis5cs\TipoPeriodoPago;

class TipoPeriodoPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         TipoPeriodoPago::create([
            'periodo_pago'=>'Anual',
            'estado'=>true                      
       ]);
          TipoPeriodoPago::create([
            'periodo_pago'=>'Semestral',
            'estado'=>true                    
       ]);
           TipoPeriodoPago::create([
            'periodo_pago'=>'Cuatrimestral',
            'estado'=>true                      
       ]);
            TipoPeriodoPago::create([
            'periodo_pago'=>'Trimestral',
            'estado'=>true                      
       ]);
            TipoPeriodoPago::create([
            'periodo_pago'=>'Mensual',
            'estado'=>true                      
       ]);
    }
}
