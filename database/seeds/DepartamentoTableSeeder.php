<?php

use Illuminate\Database\Seeder;
use sis5cs\Departamento;
class DepartamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::create([
            'nombre_departamento'=>'Potosí'
        ]);
        Departamento::create([
            'nombre_departamento'=>'Chuquisaca'
        ]);
        Departamento::create([
            'nombre_departamento'=>'Oruro'
        ]);
        Departamento::create([
            'nombre_departamento'=>'La Paz'
        ]);
        Departamento::create([
            'nombre_departamento'=>'Tarija'
        ]);
        Departamento::create([
            'nombre_departamento'=>'Beni'
        ]);
        Departamento::create([
            'nombre_departamento'=>'Santa Cruz'
        ]);
        Departamento::create([
            'nombre_departamento'=>'Cochabamba'
        ]);
        Departamento::create([
            'nombre_departamento'=>'Pando'
        ]);
    }
}
