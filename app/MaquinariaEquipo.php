<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class MaquinariaEquipo extends Model
{
    protected $table='maquinaria_equipo';
    protected $primaryKey='id_maquinaria_equi';
    public    $timestamps=true;

    protected $fillable=[
        'descripcion',
        'marca',
        'modelo',
        'anio',
        'asegurado',
        'aseguradora',
        'entidad_acreedora',
        'total',
        'id_persona'
    ];
}
