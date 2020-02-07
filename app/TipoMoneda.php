<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class TipoMoneda extends Model
{
    protected $table='tipo_moneda';
    protected $primaryKey='id_tipo_moneda';
    public    $timestamps=true;

    protected $fillable=[
        'tipo_moneda',
        'estado'
            ];
}
