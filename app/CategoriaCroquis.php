<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class CategoriaCroquis extends Model
{
     protected $table='categoria_croquis';
    protected $primaryKey='id_categoria_croquis';
    public $timestamps=true;

    protected $fillable=[
        
        'categoria',
        'estado'
    ];
}
