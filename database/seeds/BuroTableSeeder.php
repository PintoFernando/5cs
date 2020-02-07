<?php

use Illuminate\Database\Seeder;
use sis5cs\Buro;
class BuroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buro::create([
        'nombre_buro'=>'INFOCRED',
        'estado'=>true           
       ]);
        Buro::create([
        'nombre_buro'=>'ASFI',
        'estado'=>true

       ]);
    }
}
