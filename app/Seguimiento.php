<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table='seguimiento';
    protected $primaryKey='id_seguimiento';
    public $timestamps=true;

    protected $fillable=[
        'fecha_inicio',
        'fecha_fin',
        'usuario_destino',
        'area_destino',
        'observaciones',
        'desenbolsado',
        'id_persona',
        'id_area',
        'id_users'
            ];


            public function sender()
            {
                return $this->belongsTo(User::class,'id_users');
            } 
}
