<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    protected $table='credito';
    protected $primaryKey='id_credito';
    public $timestamps=true;

    protected $fillable=[
        'num_socio',
        'fecha_solicitud',
        'monto_solicitado',
        'interes_nominal',
        'pignorado',
        'plazo_meses',
        'dia_pago',
        'destino_credito',
        'id_tipo_moneda',
        'id_periodo_pago',
        'id_tamortizacion',
        'id_tcredito',
        'id_cliente',
        'id_forma_pago'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class,'id_persona');
    }
}
