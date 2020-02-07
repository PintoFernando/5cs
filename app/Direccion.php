<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table='direccion';
    protected $primaryKey='id_direccion';
    public $timestamps=true;

    protected $fillable=[
        'ciudad',
        'provincia',
        'localidad',
        'cll_principal',
        'cll_secundaria',
        'tiempo_residencia',
        'id_tipo_vivienda'
    ];


    public function persona()
  {
    return $this->belongsTo(Persona::class,'id_persona');
  }

  
}
