<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Requisitos extends Model
{
    protected $table='requisitos';
    protected $primaryKey='id_requisitos';
    public $timestamps=true;

    protected $fillable=[
    	'descripcion',
        'id_tcredito'
            ];
}
