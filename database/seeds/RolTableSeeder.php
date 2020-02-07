<?php

use Illuminate\Database\Seeder;
use sis5cs\Rol;
class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Rol::create([
            'rol'=>'ADMINISTRADOR'         
       ]);
        Rol::create([
            'rol'=>'JEFE DE CRÉDITOS'
       ]);
        Rol::create([
            'rol'=>'OFICIAL DE CRÉDITO'
       ]);
        Rol::create([
            'rol'=>'PLATAFORMA'
        ]);
        Rol::create([
            'rol'=>'CLIENTE'
        ]);
        Rol::create([
            'rol'=>'RIESGOS'
        ]);
        Rol::create([
            'rol'=>'ASESORIA'
        ]);
         Rol::create([
            'rol'=>'COMITÉ DE CREDITO'
        ]);
      
    }
}
