<?php

use Illuminate\Database\Seeder;
use sis5cs\BienesHogar;
class BienesHogarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       BienesHogar::create([
           'articulo'=>'Televisor',
           'descripcion'=>'50 ft color negro',
           'marca'=>'sansung',
           'color'=>'negro',
           'modelo'=>'adsfs',
           'estado'=>'En buen estado',
           'valor'=>3000,
           'id_persona'=>1
       ]);
      
   }
}
