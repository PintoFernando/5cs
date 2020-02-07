<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Garante extends Model
{
    protected $table='garante';
    protected $primaryKey='id_garante';
    public $timestamps=true;

    protected $fillable=[
        'garante',
        'id_persona'
    ];
}
