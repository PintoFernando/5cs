<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InmuebleFormRequest extends FormRequest
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
            'ciudad'=>'string|nullable',
            'calle'=>'string|nullable',
            'numero'=>'numeric|nullable',
            'zona'=>'string|nullable',
            'num_folio_real'=>'numeric|nullable',
            'fecha_registro'=>'date|nullable',
            'en_garantia'=>'boolean|nullable',
            'valor'=>'numeric',
            'id_persona'=>'numeric'
        ];
    }
}
