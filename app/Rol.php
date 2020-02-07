<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='rol';
    protected $primaryKey='id_rol';
    public $timestamps=true;

    protected $fillable=[
        'rol'
            ];
}
