<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Croquis extends Model
{
    protected $table='croquis';
	protected $primaryKey='id_croquis';
	public $timestamps=true;

	protected $fillable=[
		'latitud',
		'longitud',
		'detalle'
	];
}
