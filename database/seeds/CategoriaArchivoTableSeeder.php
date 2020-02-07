<?php

use Illuminate\Database\Seeder;
use sis5cs\CategoriaArchivo;
class CategoriaArchivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        CategoriaArchivo::create([
            'categoria'=>'Documentos',
            'estado'=>true
        ]);
        CategoriaArchivo::create([
            'categoria'=>'Escaneado',
             'estado'=>true
        ]);
        CategoriaArchivo::create([
            'categoria'=>'Otro',
             'estado'=>true
        ]);
    }
}
