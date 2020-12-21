<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class OrigenFondo extends Model
{
    protected $table='origen_fondo';
    protected $primaryKey='id_origen';
    public    $timestamps=true;

    protected $fillable=[
        'nombre'
    ];
}
