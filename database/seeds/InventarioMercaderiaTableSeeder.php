<?php

use Illuminate\Database\Seeder;
use sis5cs\InventarioMercaderia;
class InventarioMercaderiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventarioMercaderia::create([
            'detalle'=>'ropa ',
            'cantidad'=>100,
            'precio_unitario'=>200,
            'id_perosna'=>1
                      
       ]);

     
    }
}
