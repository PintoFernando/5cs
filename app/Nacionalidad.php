<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    protected $table='nacionalidad';
    protected $primaryKey='id_nacionalidad';
      public $incrementing = false;
    public $timestamps=true;

    protected $fillable=[
        'nacionalidad',
        'estado'
            ];
}
