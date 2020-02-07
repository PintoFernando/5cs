<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class DetallePersona extends Model
{
    protected $table='detalle_persona';
    protected $primaryKey='id_detalle_persona';
    public $timestamps=true;

    protected $fillable=[
        'ocupacion',
        'cargo',
        'tiempo_trabajo',
        'nombre_institucion',
        'calle_principal',
        'calle_secundaria',
        'telefono'
    ];
}
