<?php

use Illuminate\Database\Seeder;
use sis5cs\Credito;
class CreditoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Credito::create([
        'fecha_solicitud'=>'2010-01-23',
        'monto_solicitado'=>2300,
        'interes_nominal'=>0.4,
        'plazo_meses'=>12,
        'dia_pago'=>4,
        'cuota'=>621.2,
        'id_tipo_moneda'=>1,
        'id_periodo_pago'=>1,
        'id_tamortizacion'=>1,
        'id_tcredito'=>2,
        'id_persona'=>1,                 
        'id_destino_credito'=>1                 
       ]);

         
    }
}
