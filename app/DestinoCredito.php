<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class DestinoCredito extends Model
{
    protected $table='destino_credito';
    protected $primaryKey='id_destino_credito';
    public $timestamps=true;

    protected $fillable=[
        'destino_credito',
        'estado'
    ];
}
