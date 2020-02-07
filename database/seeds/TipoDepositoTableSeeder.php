<?php

use Illuminate\Database\Seeder;
use sis5cs\TipoDeposito;
class TipoDepositoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDeposito::create([
            'nombre_deposito'=>'CAJA DE AHORRO',
            'estado'=>true                      
       ]);
        TipoDeposito::create([
            'nombre_deposito'=>'CAJA DE AHORRO MANCOMUNADA',
            'estado'=>true                      
       ]);
        TipoDeposito::create([
            'nombre_deposito'=>'CUENTA CORRIENTE',
            'estado'=>true                      
       ]);
        TipoDeposito::create([
            'nombre_deposito'=>'CUENTA SAFI',
            'estado'=>true                     
       ]);
       TipoDeposito::create([
        'nombre_deposito'=>'DEPOSITO A PLAZO FIJO',
        'estado'=>true                      
   ]);
    }
}
