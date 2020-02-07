<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class ReporteBuro extends Model
{
    protected $table='reporte_buro';
    protected $primaryKey='id_reporte_buro';
    public $timestamps=true;

    protected $fillable=[
        'tiempo_maximo_mora',
        'id_persona',
        'id_tcredito',
        'id_buro'
    ];
}
