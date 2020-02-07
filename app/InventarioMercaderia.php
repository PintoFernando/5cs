<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class InventarioMercaderia extends Model
{
    protected $table='inventario_mercaderia';
    protected $primaryKey='id_imercaderia';
    public $timestamps=true;

    protected $fillable=[
       'detalle',
       'cantidad',
       'precio_unitario',
       'total',
       'id_persona'
    ];
}

