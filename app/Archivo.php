<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table='archivo';
    protected $primaryKey='id_archivo';
    public $timestamps=true;

    protected $fillable=[
        'archivo',
        'id_persona',
        'id_categoria'
    ];
}
