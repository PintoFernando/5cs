<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    protected $table='profesion';
    protected $primaryKey='id_profesion';
    public $timestamps=true;

    protected $fillable=[
        'profesion',
        'estado'
            ];
}
