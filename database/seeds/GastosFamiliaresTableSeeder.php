<?php

use Illuminate\Database\Seeder;
use sis5cs\GastosFamiliares;
class GastosFamiliaresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GastosFamiliares::create([
        'alimentacion'=>100,
            'energia_electrica'=>0,
            'agua'=>0,
            'telefono'=>0,
            'gas'=>0,
            'impuestos'=>0,
            'alquileres'=>0,
            'educacion'=>0,
            'transporte'=>0,
            'salud'=>0,
            'empleada'=>0,
            'diversion'=>0,
            'vestimenta'=>0,
            'otros'=>0,
            'id_persona'=>1
        ]);

       
    }
}
