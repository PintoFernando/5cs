<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class BienesHogar extends Model
{
    protected $table='bienes_hogar';
    protected $primaryKey='id_bien_hogar';
    public $timestamps=true;
    protected $fillable=[        
        'articulo',
        'descripcion',
        'marca',
        'color',
        'modelo',
        'estado',
        'valor',
        'id_persona'
    ];
}
