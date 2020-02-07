<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table='area';
    protected $primaryKey='id_area';
    public $timestamps=true;

    protected $fillable=[
        'area',
        'estado'
            ];
}
