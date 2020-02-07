<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class DatosEmpresa extends Model
{
    protected $table='datos_empresa';
    protected $primaryKey='id_datos_empresa';
    public $timestamps=true;

    protected $fillable=[
        'nombre_empresa',
        'actividad_empresa',
        'antiguedad_empresa',
        'ciudad_empresa',
        'provincia_empresa',
        'zona_empresa',
        'direccion_empresa',
        'telefono_empresa',
        'cargo_en_empresa',
        'antiguedad_en_cargo',
        'sueldo_promedio',
        'horario_trabajo',
        'dias_trabajo',
        'id_persona',
        'id_afp',
        'id_tc',
    ];
}
