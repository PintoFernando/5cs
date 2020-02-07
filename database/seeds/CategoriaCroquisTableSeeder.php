<?php

use Illuminate\Database\Seeder;
use sis5cs\CategoriaCroquis;
class CategoriaCroquisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoriaCroquis::create([
            'categoria'=>'Direccion',
             'estado'=>true
        ]);
        CategoriaCroquis::create([
            'categoria'=>'Empresa de trabajo',
             'estado'=>true
        ]);
        CategoriaCroquis::create([
            'categoria'=>'Actividad economica',
             'estado'=>true
        ]);
        CategoriaCroquis::create([
            'categoria'=>'Otro',
             'estado'=>true
        ]);
    }
}
