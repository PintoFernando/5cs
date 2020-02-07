<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GarantiaHipotecariaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre_ap_propietario'=>'string|nullable',
            'vivi_tipo'=>'string|nullable',
            'vivi_ubicacion_bien'=>'string|nullable',
            'vivi_libro_ddrr'=>'string|nullable',
            'vivi_matricula'=>'string|nullable',
            'vivi_partida'=>'string|nullable',
            'vivi_valor_comercial'=>'numeric|nullable',
            'vivi_valor_avaluo'=>'numeric|nullable',
            'vivi_empresa_valuadora'=>'string|nullable',
            'vehi_tipo'=>'string|nullable',
            'vehi_marca'=>'string|nullable',
            'vehi_modelo'=>'string|nullable',
            'vehi_rua'=>'string|nullable',
            'vehi_valor_comercial'=>'numeric|nullable',
            'vehi_valor_avaluo'=>'numeric|nullable',
            'vehi_empresa_valuadora'=>'string|nullable',
            'depo_nombres_titular_dpf1'=>'string|nullable',
            'depo_nombres_titular_dpf2'=>'string|nullable',
            'depo_num_dpf'=>'string|nullable',
            'depo_monto'=>'numeric|nullable'
        ];
    }
}
