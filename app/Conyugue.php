<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Conyugue extends Model
{
    protected $table='conyugue';
    protected $primaryKey='id_conyugue';
    public $timestamps=true;

    protected $fillable=[
        'id_persona',
        'id_cliente'
    ];
}
