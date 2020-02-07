<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Codeudor extends Model
{
   protected $table='codeudor';
    protected $primaryKey='id_codeudor';
    public $timestamps=true;

    protected $fillable=[
        'id_persona',
        'id_cliente'
    ];
}
