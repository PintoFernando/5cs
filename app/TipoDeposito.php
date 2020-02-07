<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class TipoDeposito extends Model
{
    protected $table='tipo_deposito';
    protected $primaryKey='id_tipo_deposito';
    public    $timestamps=true;

    protected $fillable=[
        'nombre_deposito',
        'estado'
            ];
}
