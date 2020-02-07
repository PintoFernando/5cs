<?php

use Illuminate\Database\Seeder;
use sis5cs\Inmueble;
class InmuebleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	Inmueble::create([
       'ciudad'=>'Potosi',
       'calle'=>'Costarica',
       'numero'=>'2434',
       'zona'=>'Satelite',
       'num_folio_real'=>'234234',
       'fecha_registro'=>'2012-01-23',
       'en_garantia'=>false,
       'valor'=>20000,
       'id_persona'=>1                     
     ]);



    }
  }
