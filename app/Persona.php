<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;
use sis5cs\Direccion;
use sis5cs\Credito;

class Persona extends Model
{
    protected $table='persona';
    protected $primaryKey='id_persona';
    public $timestamps=true;
  

    protected $fillable=[
      'id_persona',
       'ci',
       'nombre',
       'ap_paterno',
       'ap_materno',
       'ap_casada',
       'fec_nac',
       'genero',
       'celular',
       'dependientes',
       'estado_civil',
       'id_profesion',
       'id_users'
    ];

    public function automoviles()
    {
      return $this->hasMany(Vehiculo::class,'id_persona');
    }
     public function creditos()
    {
      return $this->hasMany(Credito::class,'id_persona');
    }
    public function direcciones()
    {
      return $this->hasMany(Direccion::class,'id_persona');
    }

}
