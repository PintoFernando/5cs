<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditoFormRequest extends FormRequest
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
            'fecha_solicitud'=>'date',
            'monto_solicitado'=>'numeric',
            'plazo_meses'=>'numeric',
            'dia_pago'=>'numeric',
            'id_tipo_moneda'=>'numeric',
            'id_periodo_pago'=>'numeric',
            'id_tamortizacion'=>'numeric',
            'id_tcredito'=>'numeric',
            'id_destino_credito'=>'numeric',
            'id_forma_pago'=>'numeric'
          
        ];
    }
}
