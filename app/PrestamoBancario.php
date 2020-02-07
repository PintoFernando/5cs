<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class PrestamoBancario extends Model
{
    protected $table='prestamo_bancario';
    protected $primaryKey='id_pbancario';
    public $timestamps=true;
    protected $fillable=[
       'importe_original',
       'duracion_credito',
       'importe_ultimo_pago',
       'destino_credito',
       'saldo',
       'id_entidad_bancaria',
       'id_persona',
       'id_tcredito'
    ];
}
