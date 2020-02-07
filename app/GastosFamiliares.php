<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class GastosFamiliares extends Model
{
    protected $table='gastos_familiares';
    protected $primaryKey='id_gastos_familiares';
    public $timestamps=true;

    protected $fillable=[
        'id_gastos_familiares',
        'energia_electrica',
        'agua',
        'telefono',
        'gas',
        'impuestos',
        'alquileres',
        'educacion',
        'transporte',
        'salud',
        'empleada',
        'diversion',
        'vestimenta',
        'otros',
        'detalle',
        'id_persona'
    ];
}
