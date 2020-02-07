<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InversionesFinancierasFormRequest extends FormRequest
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
            'cantidad'=>'numeric|nullable',
            'porcentaje_patrimonio_empre'=>'numeric|nullable',
            'nit'=>'string|nullable',
            'nombre_empresa'=>'string|nullable',
            'valor_nominal'=>'numeric|nullable',
            'valor_mercado'=>'numeric|required',
            'id_persona'=>'numeric'
            //
        ];
    }
}
