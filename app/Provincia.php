<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table='provincia';
    protected $primaryKey='id_provincia';
    public $timestamps=true;

    protected $fillable=[
        'nombre_prosvincia'
    ];
}
