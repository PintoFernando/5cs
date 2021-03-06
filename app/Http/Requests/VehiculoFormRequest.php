<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculoFormRequest extends FormRequest
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
           'tipo'=>'string|nullable',
           'marca'=>'string|nullable',
           'modelo'=>'string|nullable',
           'placa'=>'string|nullable',
           'rua'=>'string|nullable',
           'en_garantia'=>'boolean|nullable',
           'valor'=>'numeric',
           'id_persona'=>'numeric'
        ];
    }
}
