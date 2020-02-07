<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class DepositoBancario extends Model
{
    protected $table='deposito_bancario';
    protected $primaryKey='id_dbancario';
    public $timestamps=true;

    protected $fillable=[
        'numero_cuenta',
        'saldo',
        'id_entidad_bancaria',
        'id_tipo_deposito',
        'id_persona'       
    ];
}
