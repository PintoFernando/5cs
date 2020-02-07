<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class VentaComercializacionProducto extends Model
{
	protected $table='venta_comercializacion_productos';
	protected $primaryKey='id_venta_comercializacion';
	public $timestamps=true;

	protected $fillable=[
		'producto',
		'cantidad',
		'unidad_medida',
		'v_costo_unitario',
		'v_costo_total',
		'c_precio_unitario',
		'c_precio_total',
		'utilidad',
		'porcentaje',
		'id_persona'
	];
}
