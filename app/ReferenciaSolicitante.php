<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class ReferenciaSolicitante extends Model
{
    protected $table = 'referencias_solicitante';
    protected $primaryKey = 'id_referencia_solicitante';
    public $timestamps = true;

    protected $fillable = [
        'ap_paterno',
        'ap_materno',
        'nombre',
        'parentesco',
        'celular',
        'telefono',
        'estado',
        'id_persona'
    ];
}
