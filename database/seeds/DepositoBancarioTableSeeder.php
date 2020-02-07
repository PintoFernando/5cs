<?php

use Illuminate\Database\Seeder;
use sis5cs\DepositoBancario;
class DepositoBancarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     DepositoBancario::create([
        'numero_cuenta'=>'23423234',
        'saldo'=>23234.23423,                      
        'id_entidad_bancaria'=>1,                      
        'id_tipo_deposito'=>1,                      
        'id_persona'=>1                      
    ]);

     

 }
}
