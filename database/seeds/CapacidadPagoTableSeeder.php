<?php

use Illuminate\Database\Seeder;
use sis5cs\CapacidadPago;
class CapacidadPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CapacidadPago::create([
        'porcentaje'=>0.25,
        'amortizacion_coop_san_martin'=>600,              
        'id_persona'=>1             
       ]);
    }
}
