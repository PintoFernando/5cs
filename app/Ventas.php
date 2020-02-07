<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table='ventas';
    protected $primaryKey='id_ventas';
    public    $timestamps=true;

    protected $fillable=[
        'producto',
        'venta_diaria_min',
        'venta_diaria_max',
        'venta_semanal_min',
        'venta_semanal_max',
        'venta_mensual_min',
        'venta_mensual_max',
        'id_persona'
    ];
}
