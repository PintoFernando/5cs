<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class GastosOperativosComercializacion extends Model
{
    protected $table='gastos_operativos_comercializacion';
    protected $primaryKey='id_gastos_operativos';
    public $timestamps=true;
    protected $fillable=[
        'id_gastos_operativos',
        'combustible',
        'deposito_almacen',
        'energia_electrica',
        'agua',
        'gas',
        'telefono',
        'impuestos',
        'alquiler',
        'cuidado_sereno',
        'transporte',
        'mantenimiento',
        'publicidad',
        'otros',
        'detalle',
        'id_persona'
    ];
}
