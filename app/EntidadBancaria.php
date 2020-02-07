<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class EntidadBancaria extends Model
{
     protected $table='entidad_bancaria';
    protected $primaryKey='id_entidad_bancaria';
    public $timestamps=true;

    protected $fillable=[
        'nombre_entidad'
    ];
}
