<?php

use Illuminate\Database\Seeder;
use sis5cs\ReporteBuro;

class ReporteBuroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReporteBuro::create([
            'tiempo_maximo_mora'=>20,
            'id_persona'=>1,
            'id_buro'=>1,                      
       ]);
    }
}
