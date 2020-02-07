<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class CuentasDocumentosCobrar extends Model
{
    protected $table='cuentas_documentos_cobrar';
    protected $primaryKey='id_cuentas_docu';
    public $timestamps=true;

    protected $fillable=[
        'nit',
        'nombre_razon_social',
        'concepto',
        'saldo',
        'id_persona'
            ];
}
