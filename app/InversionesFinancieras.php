<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class InversionesFinancieras extends Model
{
    protected $table='inversiones_financieras';
    protected $primaryKey='id_inversion_financiera';
    public $timestamps=true;

    protected $fillable=[
        'id_inversion_financiera',
        'cantidad',
        'porcentaje_patrimonio_empre',
        'nit',
        'nombre_empresa',
        'valor_nominal',
        'valor_mercado',
        'id_persona'
    ];
}
