<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table='departamento';
    protected $primaryKey='id_departamento';
    public $timestamps=true;

    protected $fillable=[
        'nombre_departamento',
        'id_direccion'
    ];
}
