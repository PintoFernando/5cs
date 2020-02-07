<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table='cliente';
    protected $primaryKey='id_cliente';
    public $timestamps=true;

    protected $fillable=[
        
        'num_socio',
        'id_persona'
    ];
}
