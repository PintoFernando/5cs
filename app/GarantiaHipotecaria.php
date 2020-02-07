<?php

namespace sis5cs;

use Illuminate\Database\Eloquent\Model;

class GarantiaHipotecaria extends Model
{
    protected $table='garantia_hipotecaria';
    protected $primaryKey='id_garantia_hipotecaria';
    public $timestamps=true;

    protected $fillable=[
        'nombre_ap_propietario',
        'vivi_tipo',
        'vivi_ubicacion_bien',
        'vivi_libro_ddrr',
        'vivi_matricula',
        'vivi_partida',
        'vivi_valor_comercial',
        'vivi_valor_avaluo',
        'vivi_empresa_valuadora',
        'vehi_tipo',
        'vehi_marca',
        'vehi_modelo',
        'vehi_rua',
        'vehi_valor_comercial',
        'vehi_valor_avaluo',
        'vehi_vehi_empresa_valuadora',
        'depo_nombres_depo_titular_dpf1',
        'depo_nombres_depo_titular_dpf2',
        'depo_num_dpf',
        'depo_monto'
    ];
}
