<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class IngresoMensual extends Model
{
    protected $table='ingreso_mensual';
    protected $primaryKey='id_ingreso_mensual';
    public $timestamps=true;

    protected $fillable=[
        'mes',
        'anio',
        'prestatario',
        'conyugue',
        'otros',
        'codeudores',
        'total_ingreso',
        'descripcion',
        'id_persona'
    ];
}
