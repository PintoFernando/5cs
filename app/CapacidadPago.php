<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class CapacidadPago extends Model
{
    protected $table='capacidad_pago';
    protected $primaryKey='id_capacidad_pago';
    public $timestamps=true;

    protected $fillable=[
        
        'id_capacidad_pago',
        'porcentaje',
        'amortizacion_coop_san_martin',
        'id_tcredito',
        'id_persona'
    ];
}
