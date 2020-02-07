<?php

use Illuminate\Database\Seeder;
use sis5cs\PrestamoBancario;
class PrestamoBancarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PrestamoBancario::create([
            'importe_original'=>1000,
            'duracion_credito'=>4,
            'importe_ultimo_pago'=>400,
            'destino_credito'=>'otros',
            'saldo'=>200,
            'id_entidad_bancaria'=>2,
            'id_persona'=>1,
            'id_tcredito'=>2                      
       ]);
    

    }
}
