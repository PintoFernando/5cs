<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class ManoObraMensual extends Model
{
    protected $table='mano_obra_mensual';
    protected $primaryKey='id_mano_obra';
    public $timestamps=true;

    protected $fillable=[
       'descripcion_cargos',
       'num_personas',
       'sueldo_mensual',
       'id_persona'
    ];
}
