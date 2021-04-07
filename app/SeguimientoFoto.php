<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class SeguimientoFoto extends Model
{
    protected $table='seguimiento_fotografico';
    protected $primaryKey='id_seguimiento_foto';
    public $timestamps=true;

    protected $fillable=[
        
        'descripcion',
         'id_credito',
         'longitud',
         'latitud'
        
    ];

    public function creditosolo(){
        return $this->hasOne(Credito::class, 'id_credito');
      
  
  }
  public function creditopersona(){
          return $this->hasOne(Persona::class, 'id_persona');
  }
   
  
}
