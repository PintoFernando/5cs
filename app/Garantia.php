<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    protected $table='garantia';
    protected $primaryKey='id_garantia';
    public $timestamps=true;

    protected $fillable=[
        'id_credito',
        'id_tipo_garantia'
    ];
}
