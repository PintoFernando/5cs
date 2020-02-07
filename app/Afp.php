<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Afp extends Model
{
    protected $table='afp';
    protected $primaryKey='id_afp';
    public $timestamps=true;
    protected $fillable=[
        'nombre_afp',
        'estado'
            ];
}
