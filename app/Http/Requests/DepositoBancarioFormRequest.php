<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositoBancarioFormRequest extends FormRequest
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
            'numero|cuenta'=>'numeric|nullable',
            'saldo'=>'numeric',
            'id_entidad_bancaria'=>'numeric',
            'id_tipo_deposito'=>'numeric',
            'id_persona'=>'numeric'
        ];
    }
}
