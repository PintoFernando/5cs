<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class TipoCredito extends Model
{
     protected $table='tipo_credito';
    protected $primaryKey='id_tcredito';
    public    $timestamps=true;

    protected $fillable=[
        'tipo_credito',
        'estado'
            ];
}
