<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    protected $table='forma_pago';
    protected $primaryKey='id_forma_pago';
    public $timestamps=true;
    protected $fillable=[
        'forma_pago',
        'estado'
    ];
}
