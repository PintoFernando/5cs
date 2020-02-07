<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;
class ActividadEconomica extends Model
{
    protected $table='actividad_economica';
    protected $primaryKey='id_actividad_economica';
    public $timestamps=true;

    protected $fillable=[
        'ciudad_ae',
        'provincia_ae',
        'zona_ae',
        'direccion_ae',
        'telefono_ae',
        'actividad_qrealiza',
        'nit_ae',
        'horario_trabajo_ae',
        'dias_trabajo_ae',      
        'antiguedad_trabajo_ae',
        'ingreso_promedio_ae',
        'id_persona'
    ];
}
