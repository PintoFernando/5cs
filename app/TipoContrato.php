<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class TipoContrato extends Model
{
    protected $table='tipo_contrato';
    protected $primaryKey='id_tc';
    public    $timestamps=true;

    protected $fillable=[
        'nombre_tc',
        'estado'
            ];
}
