<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table='foto';
    protected $primaryKey='id_foto';
    public $timestamps=true;

    protected $fillable=[
        'archivo',
        'detalle',
        'id_persona',
        'id_credito',
        'id_categoria',
        'id_seguimiento_foto'
    ];
    public function foto1(){
        return $this->hasMany(Credito::class, 'id_persona');
}
public function foto2(){
    return $this->hasMany(Persona::class, 'id_persona');
}
public function foto3(){
    return $this->hasMany(Foto::class, 'id_persona');
}
}
