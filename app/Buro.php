<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Buro extends Model
{
    protected $table='buros';
    protected $primaryKey='id_buro';
    public $timestamps=true;

    protected $fillable=[        
        'nombre_buro',
        'estado'
    ];
}
