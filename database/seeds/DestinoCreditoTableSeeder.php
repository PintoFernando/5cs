<?php

use Illuminate\Database\Seeder;
use sis5cs\DestinoCredito;
class DestinoCreditoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DestinoCredito::create([
            'destino_credito'=>'Consumo',
            'estado'=>true                    
       ]);
      
       DestinoCredito::create([
            'destino_credito'=>'Vivienda',
            'estado'=>true  

       ]);
       DestinoCredito::create([
          'destino_credito'=>'Libre disponibilidad',
          'estado'=>true                       
     ]);
     DestinoCredito::create([
          'destino_credito'=>'Otro',
          'estado'=>true                      
     ]);
    }
}
