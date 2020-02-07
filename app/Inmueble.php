<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    protected $table='inmueble';
    protected $primaryKey='id_inmueble';
    public $timestamps=true;

    protected $fillable=[
       'ciudad',
       'calle',
       'numero',
       'zona',
       'num_folio_real',
       'fecha_registro',
       'en_garantia',
       'valor',
       'id_persona'
    ];
}
