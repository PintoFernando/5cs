<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class CategoriaFoto extends Model
{
    protected $table='categoria_foto';
    protected $primaryKey='id_categoria_foto';
    public $timestamps=true;

    protected $fillable=[
        
        'categoria',
        'estado'
    ];
}
