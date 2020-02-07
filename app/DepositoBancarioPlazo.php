<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class DepositoBancarioPlazo extends Model
{
    protected $table='deposito_bancario_plazo';
    protected $primaryKey='id_dbancario_plazo';
    public $timestamps=true;

    protected $fillable=[
        'numero_cuenta',
        'plazo',
        'fecha_apertura',
        'el_deposito_esta_garantia',
        'nombre_entidad_acreedora',
        'saldo',
        'id_persona',
        'id_entidad_bancaria'
    ];
}
