<?php

use Illuminate\Database\Seeder;
use sis5cs\Provincia;
class ProvinciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincia::create([
            'nombre_provincia'=>'Abogado',
            'capital'=>'Abogado',
            'id_departamento'=>'Abogado'
        ]);
    }
}
