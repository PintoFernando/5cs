<?php

use Illuminate\Database\Seeder;
use sis5cs\Vehiculo;
class VehiculoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehiculo::create([
            'tipo' => 'Camioneta',
            'marca' => 'Nissan',
            'modelo' => '2000',
            'placa' => 's423',
            'rua' => '234234',
            'en_garantia' => true,
            'valor' => 23423,
            'id_persona' => 1
        ]);      
    }
}
