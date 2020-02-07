<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Directorio extends Model
{
    protected $table='directorio';
    protected $primaryKey='id';
    public $timestamps=true;
    protected $fillable=[        
        'id',
        'nombre',
        'telefono'
    ];
}
