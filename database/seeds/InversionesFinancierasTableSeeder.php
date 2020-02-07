<?php

use Illuminate\Database\Seeder;
use sis5cs\InversionesFinancieras;
class InversionesFinancierasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InversionesFinancieras::create([
            'cantidad' => 1,
            'porcentaje_patrimonio_empre' => 100,
            'nit' => '6567567',
            'nombre_empresa' => 'Compotosi',
            'valor_nominal' => 123123,
            'valor_mercado' => 123123,
            'id_persona' => 1
        ]);
     
    }
}
