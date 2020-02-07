<?php

use Illuminate\Database\Seeder;
use sis5cs\Ventas;
class VentasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ventas::create([
            'producto'=>'Camioneta',
            'venta_diaria_min'=>1234,
            'venta_diaria_max'=>12343,
            'venta_semanal_min'=>234,
            'venta_semanal_max'=>23423,
            'venta_mensual_min'=>234233,
            'venta_mensual_max'=>23423,
            'id_persona'=>1
        ]);
    
    }
}
