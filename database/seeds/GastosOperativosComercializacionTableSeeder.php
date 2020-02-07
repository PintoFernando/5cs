<?php

use Illuminate\Database\Seeder;
use sis5cs\GastosOperativosComercializacion;
class GastosOperativosComercializacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GastosOperativosComercializacion::create([
            'combustible'=>100,
            'deposito_almacen'=>0,
            'energia_electrica'=>0,
            'agua'=>0,
            'gas'=>0,
            'telefono'=>0,
            'impuestos'=>0,
            'alquiler'=>0,
            'cuidado_sereno'=>0,
            'transporte'=>0,
            'mantenimiento'=>0,
            'publicidad'=>0,
            'otros'=>0,
            'id_persona'=>1
        ]);       
    }
}
