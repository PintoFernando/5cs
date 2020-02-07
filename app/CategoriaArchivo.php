<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class CategoriaArchivo extends Model
{
    protected $table='categoria_archivo';
    protected $primaryKey='id_categoria_archivo';
    public $timestamps=true;

    protected $fillable=[
        
        'categoria',
        'estado'
    ];
}
