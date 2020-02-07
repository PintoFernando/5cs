<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class OtroActivo extends Model
{
     protected $table='otros_activos';
    protected $primaryKey='id_otros_activos';
    public $timestamps=true;

    protected $fillable=[
        'detalle',
        'en_garantia',
        'total'
    ];
}
