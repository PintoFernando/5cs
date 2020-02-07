<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class TipoCambio extends Model
{
    protected $table = 'tipo_cambio';
    protected $primaryKey = 'id_tipo_cambio';
    public $timestamps = true;

    protected $fillable = [
        'cambio'
    ];
}
