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
        'id_persona',
        'id_categoria'
    ];
}
