<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class TipoPeriodoPago extends Model
{
    protected $table='tipo_periodo_pago';
    protected $primaryKey='id_periodo_pago';
    public    $timestamps=true;

    protected $fillable=[
        'periodo_pago',
        'estado'
            ];
}
