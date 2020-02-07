<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class EfectivoCaja extends Model
{
     protected $table='efectivos_caja';
    protected $primaryKey='id_efectivos_caja';
    public $timestamps=true;

    protected $fillable=[
        'caja'
    ];
}
