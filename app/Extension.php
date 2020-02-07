<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    protected $table='extension_ci';
    protected $primaryKey='id_ext';
    public $timestamps=true;

    protected $fillable=[
        'extension'
    ];
}
