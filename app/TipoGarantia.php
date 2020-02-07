<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class TipoGarantia extends Model
{
    protected $table='tipo_garantia';
    protected $primaryKey='id_tipo_garantia';
    public    $timestamps=true;

    protected $fillable=[
        'tipo_garantia',
        'estado'
            ];
}
