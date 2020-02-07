<?php

use Illuminate\Database\Seeder;
use sis5cs\Area;
class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Area::create([
           'area'=>'PLATAFORMA',
           'estado'=>true
       ]);
         Area::create([
           'area'=>'OF. CRÉDITOS',
           'estado'=>true

       ]);
           Area::create([
           'area'=>'ENC. CRÉDITO',
           'estado'=>true
       ]);
         Area::create([
           'area'=>'ENC. RIESGOS',
           'estado'=>true
       ]);
         Area::create([
           'area'=>'ASESORIA',
           'estado'=>true
       ]);
           Area::create([
           'area'=>'COMITÉ DE CRÉDITO',
           'estado'=>true
       ]);
    }
    
}
