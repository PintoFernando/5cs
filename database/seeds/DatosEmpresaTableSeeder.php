<?php

use Illuminate\Database\Seeder;
use sis5cs\DatosEmpresa;

class DatosEmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DatosEmpresa::create([
            'nombre_empresa'=>'Entel',
            'actividad_empresa'=>'Telefonia',
            'antiguedad_empresa'=>'12-12-1999',
            'ciudad_empresa'=>'Potosí',
            'provincia_empresa'=>'Tomas Frias',
            'zona_empresa'=>'Satelite',
            'direccion_empresa'=>'Calle Costarica # 98',
            'telefono_empresa'=>'62443425',
            'cargo_en_empresa'=>'sistemas',
            'antiguedad_en_cargo'=>'12-12-1999',
            'horario_trabajo'=>'12:00 a 18:00',
            'dias_trabajo'=>'Lunes a viernes',
            'id_persona'=>1,
            'id_afp'=>3,
            'id_tc'=>3
        ]);

        
    }
}
