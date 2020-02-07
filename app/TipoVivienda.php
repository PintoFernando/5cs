<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class TipoVivienda extends Model
{
    protected $table='tipo_vivienda';
    protected $primaryKey='id_tipo_vivienda';
    public    $timestamps=true;

    protected $fillable=[
        'tipo_vivienda',
        'estado'
            ];
}
