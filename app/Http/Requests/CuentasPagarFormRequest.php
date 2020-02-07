<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuentasPagarFormRequest extends FormRequest
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
        'institucion'=>'string|nullable',
        'tiempo'=>'date|nullable',
        'cuota_mensual'=>'numeric|nullable',
        'saldo'=>'numeric|required',
        'id_persona'=>'numeric'
        ];
    }
}
