<?php

use Illuminate\Database\Seeder;
use sis5cs\TipoMoneda;
class TipoMonedaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       TipoMoneda::create([
            'tipo_moneda'=>'Bs.',
            'estado'=>true                      
       ]);

       TipoMoneda::create([
            'tipo_moneda'=>'$us.',
            'estado'=>true                     
       ]);
    }
}
