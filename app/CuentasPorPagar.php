<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class CuentasPorPagar extends Model
{
    protected $table='cuentas_por_pagar';
    protected $primaryKey='id_cppagar';
    public $timestamps=true;

    protected $fillable=[
        'institucion',
        'tiempo',
        'cuota_mensual',
        'saldo',
        'id_persona'
    ];
}
