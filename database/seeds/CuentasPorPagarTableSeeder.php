<?php

use Illuminate\Database\Seeder;
use sis5cs\CuentasPagar;

class CuentasPorPagarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CuentasPagar::create([
         'institucion'=>'Colegio',
         'tiempo'=>'2012-01-23',
         'cuota_mensual'=>534,
         'saldo'=>23423,
         'id_persona'=>1
        ]);

        
    }
}
