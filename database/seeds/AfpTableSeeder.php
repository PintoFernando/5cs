<?php

use Illuminate\Database\Seeder;
use sis5cs\Afp;
class AfpTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Afp::create([
        'nombre_afp'=>'AFP Prevision',
        'estado'=>true
        
      ]);
      Afp::create([
        'nombre_afp'=>'BBVA Prevision',
        'estado'=>true     
      ]);
      Afp::create([
        'nombre_afp'=>'AFP Futuro de Bolivia',
        'estado'=>true      
      ]);
      Afp::create([
        'nombre_afp'=>'NO APORTA',
        'estado'=>true        
      ]);
    }
  }
