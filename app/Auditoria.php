<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table='pistasauditoria';
    protected $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[        
        'tabla',
        'accion',
        'datosantiguos',
        'datosnuevos',
        'fechamodificacion',
        'nick',
        'usuariobd'
        
    ];
}
