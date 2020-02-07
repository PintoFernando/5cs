<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class TipoAmortizacion extends Model
{
    protected $table='tipo_amortizacion';
    protected $primaryKey='id_tamortizacion';
    public    $timestamps=true;

    protected $fillable=[
        'amortizacion',
        'estado'
            ];
}
