<?php

use Illuminate\Database\Seeder;
use sis5cs\Persona;
class PersonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Persona::create([
            'ci'=>'6629602',
            'nombre'=>'Carlos',
            'ap_paterno'=>'García',
            'ap_materno'=>'Lima',
            'ap_casada'=>'',
            'fec_nac'=>'1998-02-21',
            'lugar_nac'=>'Potosí',
            'genero'=>'Masculino',
            'celular'=>'23423423',
            'dependientes'=>1,
            'id_profesion'=>2 ,  
            'id_ext'=>5,  
            'id_estado_civil'=>2 ,   
            'id_nacionalidad'=>4    
       ]);
     
    }
}
